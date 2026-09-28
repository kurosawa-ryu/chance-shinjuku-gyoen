import { zodResolver } from "@hookform/resolvers/zod";
import StepConfirmationEn from "@src/js/components/reserved/StepConfirmationEn";
import StepCustomerInfoEn from "@src/js/components/reserved/StepCustomerInfoEn";
import StepIndicatorEn from "@src/js/components/reserved/StepIndicatorEn";
import StepReservationDetailsEn from "@src/js/components/reserved/StepReservationDetailsEn";
import ThanksPageEn from "@src/js/components/reserved/ThanksPageEn";
import { useMultiStepForm } from "@src/js/hooks/useMultiStepForm";
import { useQueryParamToForm } from "@src/js/hooks/useQueryParamToForm";
import { ReservationFormData } from "@src/js/schema/reservationSchema";
import {
	DurationEn,
	ReservationFormDataEn,
	courseDurationsEn,
	courseTypesEn,
	reservationSchemaEn,
} from "@src/js/schema/reservationSchemaEn";
import axios from "axios";
import React, { useEffect, useState } from "react";
import { Button, Form } from "react-bootstrap";
import { type Path, useForm } from "react-hook-form";

const FORM_ID = "768";
const ENDPOINT = `/wp-json/contact-form-7/v1/contact-forms/${FORM_ID}/feedback`;
const UNIT_TAG = `wpcf7-f${FORM_ID}-p1-o1`;

const validationFields: Path<ReservationFormData>[][] = [
	[
		"course-type",
		"course-duration",
		"reservation-month",
		"reservation-day",
		"reservation-hour",
		"reservation-minute",
		"cast-name",
		"cast2-name",
		"delivery-location",
		"cast-anal-play",
		"cast2-anal-play",
		"has-discount-ticket",
		"has-meal-during-course",
		"has-previous-cast2",
		"date-combined",
	],
	[
		"your-name",
		"your-email",
		"email-confirm",
		"your-tel",
		"has-previous-cast",
		"has-previous-visit",
	],
	[],
];

const ReservationFormEn: React.FC = () => {
	const [availableDurations, setAvailableDurations] = useState<DurationEn[]>(
		[],
	);
	const [isError, setIsError] = useState(false);

	const {
		register,
		watch,
		handleSubmit,
		trigger,
		setValue,
		formState: { errors, isValid },
	} = useForm<ReservationFormData>({
		resolver: zodResolver(reservationSchemaEn),
		mode: "onChange",
	});

	const selectedCourseType = watch("course-type");
	const selectedCourseDuration = watch("course-duration");

	// 3Pコースのときだけバリデーション対象に追加
	const step1Fields = [...validationFields[0]];
	if (["3p-60min", "3p-90min", "3p-120min"].includes(selectedCourseDuration)) {
		step1Fields.push("boy-interaction");
	}
	const dynamicValidationFields = [step1Fields, ...validationFields.slice(1)];

	const { currentStep, handleNext, handleBack, goToStep, isFirstStep } =
		useMultiStepForm<ReservationFormData>({
			totalSteps: 4,
			trigger,
			validationFields: dynamicValidationFields,
		});

	// URLクエリパラメータからboyを取得してcast-nameに設定
	useQueryParamToForm("boy", "cast-name", setValue);

	useEffect(() => {
		if (selectedCourseType) {
			switch (selectedCourseType) {
				case courseTypesEn.PRIVATE_ROOM:
					setAvailableDurations([...courseDurationsEn.PRIVATE_ROOM]);
					break;
				case courseTypesEn.DELIVERY:
					setAvailableDurations([...courseDurationsEn.DELIVERY]);
					break;
				case courseTypesEn.DATE_ONLY:
					setAvailableDurations([...courseDurationsEn.DATE_ONLY]);
					break;
				default:
					setAvailableDurations([]);
			}
		}
	}, [selectedCourseType]);

	const onSubmit = async (data: ReservationFormData) => {
		try {
			// emailConfirmは不要なので送らない
			const { "email-confirm": emailConfirm, ...rest } = data;
			const sendData = {
				...rest,
				_wpcf7_unit_tag: UNIT_TAG,
			};

			const response = await axios.post(ENDPOINT, sendData, {
				headers: {
					"Content-Type": "multipart/form-data",
				},
			});

			console.log(response);
			// if (response.data.status === "validation_failed") {
			// 	// エラーにする
			//   // catchできるようにする
			//   throw new Error("予約送信エラー");
			// } else {
			goToStep(4);
			// }
		} catch (error) {
			console.error("予約送信エラー:", error);
			setIsError(true);
		}
	};

	return (
		<Form
			noValidate
			onSubmit={handleSubmit(onSubmit)}
			className="reservation-form p-4"
		>
			<StepIndicatorEn currentStep={currentStep} />
			{isError && (
				<div className="alert alert-danger text-center mb-3" role="alert">
					An error occurred while sending the reservation.
					<br />
					Please try again.
					<br />
					<span className="d-block mt-2">
						If you are in a hurry, you can also make a reservation by phone or
						LINE.
					</span>
				</div>
			)}

			{currentStep === 1 && (
				<StepReservationDetailsEn
					register={register}
					errors={errors}
					watch={watch}
					availableDurations={availableDurations}
				/>
			)}
			{currentStep === 2 && (
				<StepCustomerInfoEn register={register} errors={errors} watch={watch} />
			)}
			{currentStep === 3 && <StepConfirmationEn watch={watch} />}
			{currentStep === 4 && <ThanksPageEn />}

			<div className="d-flex flex-column gap-2 justify-content-center align-items-center mt-4">
				{!isFirstStep && currentStep < 4 && (
					<Button
						variant="secondary"
						onClick={handleBack}
						className="w-50 mx-auto"
					>
						Back
					</Button>
				)}
				{currentStep < 3 && (
					<Button
						variant="primary"
						onClick={() => handleNext()}
						className="w-50 mx-auto"
					>
						Next
					</Button>
				)}
				{currentStep === 3 && (
					<Button
						variant="success"
						type="submit"
						disabled={!isValid}
						className="w-50 mx-auto"
					>
						Confirm Reservation
					</Button>
				)}
			</div>
		</Form>
	);
};

export default ReservationFormEn;
