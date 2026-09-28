import { zodResolver } from "@hookform/resolvers/zod";
import StepConfirmation from "@src/js/components/reserved/StepConfirmation";
import StepCustomerInfo from "@src/js/components/reserved/StepCustomerInfo";
import StepIndicator from "@src/js/components/reserved/StepIndicator";
import StepReservationDetails from "@src/js/components/reserved/StepReservationDetails";
import ThanksPage from "@src/js/components/reserved/ThanksPage";
import { useMultiStepForm } from "@src/js/hooks/useMultiStepForm";
import { useQueryParamToForm } from "@src/js/hooks/useQueryParamToForm";
import {
	Duration,
	ReservationFormData,
	courseDurations,
	courseTypes,
	reservationSchema,
} from "@src/js/schema/reservationSchema";
import axios from "axios";
import React, { useEffect, useState } from "react";
import { Button, Form } from "react-bootstrap";
import { type Path, useForm } from "react-hook-form";

const FORM_ID = "6";
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

const ReservationForm: React.FC = () => {
	const [availableDurations, setAvailableDurations] = useState<Duration[]>([]);
	const [isError, setIsError] = useState(false);

	const {
		register,
		watch,
		handleSubmit,
		trigger,
		setValue,
		formState: { errors, isValid },
	} = useForm<ReservationFormData>({
		resolver: zodResolver(reservationSchema),
		mode: "onChange",
	});

	const selectedCourseType = watch("course-type");
	const selectedCourseDuration = watch("course-duration");

	// 3Pコースのときだけバリデーション対象に追加
	const step1Fields = [...validationFields[0]];
	if (["3P 60分", "3P 90分", "3P 120分"].includes(selectedCourseDuration)) {
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
				case courseTypes.PRIVATE_ROOM:
					setAvailableDurations([...courseDurations.PRIVATE_ROOM]);
					break;
				case courseTypes.DELIVERY:
					setAvailableDurations([...courseDurations.DELIVERY]);
					break;
				case courseTypes.DATE_ONLY:
					setAvailableDurations([...courseDurations.DATE_ONLY]);
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
			<StepIndicator currentStep={currentStep} />
			{isError && (
				<div className="alert alert-danger text-center mb-3" role="alert">
					予約の送信中にエラーが発生しました。
					<br />
					お手数ですが、再度お試しくださいますようお願いいたします。
					<br />
					<span className="d-block mt-2">
						お急ぎの場合は、お電話でのご予約も承っておりますので、ご利用ください。
					</span>
				</div>
			)}

			{currentStep === 1 && (
				<StepReservationDetails
					register={register}
					errors={errors}
					watch={watch}
					availableDurations={availableDurations}
				/>
			)}
			{currentStep === 2 && (
				<StepCustomerInfo register={register} errors={errors} watch={watch} />
			)}
			{currentStep === 3 && <StepConfirmation watch={watch} />}
			{currentStep === 4 && <ThanksPage />}

			<div className="d-flex flex-column gap-2 justify-content-center align-items-center mt-4">
				{!isFirstStep && currentStep < 4 && (
					<Button
						variant="secondary"
						onClick={handleBack}
						className="w-50 mx-auto"
					>
						戻る
					</Button>
				)}
				{currentStep < 3 && (
					<Button
						variant="primary"
						onClick={() => handleNext()}
						className="w-50 mx-auto"
					>
						次へ
					</Button>
				)}
				{currentStep === 3 && (
					<Button
						variant="success"
						type="submit"
						disabled={!isValid}
						className="w-50 mx-auto"
					>
						送信する
					</Button>
				)}
			</div>
		</Form>
	);
};

export default ReservationForm;
