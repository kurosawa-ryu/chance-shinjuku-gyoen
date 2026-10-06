import { zodResolver } from "@hookform/resolvers/zod";
import StepIndicatorEn from "@src/js/components/survey/StepIndicatorEn";
import StepSurveyBasicInfoEn from "@src/js/components/survey/StepSurveyBasicInfoEn";
import StepSurveyBoyEvaluationEn from "@src/js/components/survey/StepSurveyBoyEvaluationEn";
import StepSurveyConfirmationEn from "@src/js/components/survey/StepSurveyConfirmationEn";
import StepSurveyShopEvaluationEn from "@src/js/components/survey/StepSurveyShopEvaluationEn";
import ThanksPageEn from "@src/js/components/survey/ThanksPageEn";
import { useMultiStepForm } from "@src/js/hooks/useMultiStepForm";
import {
	type SurveyFormDataEn,
	surveySchemaEn,
} from "@src/js/schema/surveySchemaEn";
import axios from "axios";
import React, { useRef, useState } from "react";
import { Alert, Button, Form } from "react-bootstrap";
import { type Path, useForm } from "react-hook-form";

const FORM_ID = "11964"; // Contact Form 7のID
const ENDPOINT = `/wp-json/contact-form-7/v1/contact-forms/${FORM_ID}/feedback`;
const UNIT_TAG = `wpcf7-f${FORM_ID}-p1-o1`;

// 各ステップでバリデーションするフィールド名を定義
const validationFields: Path<SurveyFormDataEn>[][] = [
	[
		"your-name",
		"your-email",
		"reservation-month",
		"reservation-day",
		"reservation-hour",
		"reservation-minute",
		"course-type",
		"course-duration",
		"cast-name",
		"visit-count",
	],
	["cast-impression", "cast-photo-gap", "cast-language", "cast-again"],
	[
		// 3ページ目は全て任意項目なのでバリデーション不要
	],
	[], // 確認画面はバリデーションなし
];

const SurveyFormEn: React.FC = () => {
	const [isError, setIsError] = useState(false);
	const formRef = useRef<HTMLFormElement | null>(null);

	const {
		register,
		watch,
		handleSubmit,
		trigger,
		getValues,
		formState: { errors, isValid, isSubmitting },
	} = useForm<SurveyFormDataEn>({
		resolver: zodResolver(surveySchemaEn),
		mode: "onChange",
		defaultValues: {
			"your-name": "",
			"your-email": "",
			"reservation-month": "",
			"reservation-day": "",
			"reservation-hour": "",
			"reservation-minute": "",
			"course-type": "",
			"course-duration": "",
			"cast-name": "",
			"visit-count": "First time",
			"cast-impression": "Very positive",
			"cast-photo-gap": "Better than expected",
			"cast-language": "Very good",
			"cast-service": "",
			"cast-again": "Would book again",
			"reception-response": "Very good",
			"reception-response-concern": "",
			"website-concern": "Very good",
			"system-concern": "Very good",
			"price-concern": "Very good",
			"other-concern": "",
			"publisibal-cast-review": "Can be published",
		},
	});

	const { currentStep, handleNext, handleBack, goToStep, isFirstStep } =
		useMultiStepForm<SurveyFormDataEn>({
			totalSteps: 5, // Basic Info → Boy Evaluation → Store Evaluation → Confirmation → Thanks
			trigger,
			validationFields,
		});

	const onSubmit = async (data: SurveyFormDataEn) => {
		try {
			const sendData = {
				...data,
				_wpcf7_unit_tag: UNIT_TAG,
			};

			const response = await axios.post(ENDPOINT, sendData, {
				headers: {
					"Content-Type": "multipart/form-data",
				},
			});

			console.log("Survey data:", response);
			goToStep(5, "survey-form");
		} catch (error) {
			setIsError(true);
		}
	};

	return (
		<>
			{currentStep === 5 ? (
				<ThanksPageEn />
			) : (
				<Form
					ref={formRef}
					noValidate
					onSubmit={handleSubmit(onSubmit)}
					className="bg-white rounded shadow-sm p-4 mb-4"
				>
					<StepIndicatorEn currentStep={currentStep} />

					{isError && (
						<Alert variant="danger" className="text-center mb-3" role="alert">
							An error occurred while submitting the survey.
							<br />
							Please try again.
						</Alert>
					)}

					{currentStep === 1 && (
						<StepSurveyBasicInfoEn
							register={register}
							watch={watch}
							errors={errors}
						/>
					)}

					{currentStep === 2 && (
						<StepSurveyBoyEvaluationEn
							register={register}
							watch={watch}
							errors={errors}
						/>
					)}

					{currentStep === 3 && (
						<StepSurveyShopEvaluationEn
							register={register}
							watch={watch}
							errors={errors}
						/>
					)}

					{currentStep === 4 && (
						<StepSurveyConfirmationEn
							formData={getValues()}
							onBack={handleBack}
							onSubmit={handleSubmit(onSubmit)}
							isSubmitting={isSubmitting}
						/>
					)}

					<div className="d-flex justify-content-between mt-4">
						{!isFirstStep && currentStep < 4 && (
							<Button variant="secondary" onClick={handleBack}>
								Back
							</Button>
						)}
						{currentStep < 4 && (
							<Button
								variant="primary"
								onClick={() => handleNext("survey-form")}
								disabled={isSubmitting}
							>
								{currentStep === 3 ? "Review" : "Next"}
							</Button>
						)}
					</div>
				</Form>
			)}
		</>
	);
};

export default SurveyFormEn;
