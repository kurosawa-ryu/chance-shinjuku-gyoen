import RadioGroupFieldEn from "@src/js/components/common/FormFields/RadioGroupFieldEn";
import TextareaFieldEn from "@src/js/components/common/FormFields/TextareaFieldEn";
import { SurveyFormDataEn } from "@src/js/schema/surveySchemaEn";
import React from "react";
import { FieldErrors, UseFormRegister, UseFormWatch } from "react-hook-form";

type StepSurveyShopEvaluationEnProps = {
	register: UseFormRegister<SurveyFormDataEn>;
	watch: UseFormWatch<SurveyFormDataEn>;
	errors: FieldErrors<SurveyFormDataEn>;
};

const attitudeOptionsEn = {
	VERY_GOOD: "Very good",
	GOOD: "Good",
	NORMAL: "Normal",
	BAD: "Bad",
	VERY_BAD: "Very bad",
} as const;

const shopServiceOptionsEn = {
	NONE: "None",
	FAST_TALKING: "Speaking too fast",
	QUIET_VOICE: "Quiet voice",
	HARD_TO_HEAR: "Hard to hear",
	BAD_EXPLANATION: "Poor explanation",
	AGGRESSIVE: "Aggressive",
	BUSINESSLIKE: "Too businesslike",
	FRIVOLOUS: "Frivolous",
} as const;

const StepSurveyShopEvaluationEn: React.FC<StepSurveyShopEvaluationEnProps> = ({
	register,
	watch,
	errors,
}) => {
	return (
		<>
			<TextareaFieldEn<SurveyFormDataEn>
				label="Any concerns about phone service or customer service"
				name="reception-response-concern"
				register={register}
				errors={errors}
				rows={3}
				placeholder="Please describe any concerns about our phone service or customer service"
			/>

			<RadioGroupFieldEn<SurveyFormDataEn>
				label="How was our website?"
				name="website-concern"
				register={register}
				errors={errors}
				options={Object.entries(attitudeOptionsEn).map(([, value]) => ({
					value,
					label: value,
				}))}
				required
				defaultValue={attitudeOptionsEn.VERY_GOOD}
			/>

			<RadioGroupFieldEn<SurveyFormDataEn>
				label="How was our system?"
				name="system-concern"
				register={register}
				errors={errors}
				options={Object.entries(attitudeOptionsEn).map(([, value]) => ({
					value,
					label: value,
				}))}
				required
				defaultValue={attitudeOptionsEn.VERY_GOOD}
			/>

			<RadioGroupFieldEn<SurveyFormDataEn>
				label="How was our pricing?"
				name="price-concern"
				register={register}
				errors={errors}
				options={Object.entries(attitudeOptionsEn).map(([, value]) => ({
					value,
					label: value,
				}))}
				required
				defaultValue={attitudeOptionsEn.VERY_GOOD}
			/>

			<TextareaFieldEn<SurveyFormDataEn>
				label="Please share any opinions, requests, or feedback about our store"
				name="other-concern"
				register={register}
				errors={errors}
				rows={5}
				placeholder="Please share your opinions and requests"
				maxLength={2000}
			/>

			<div className="mb-4">
				<p className="mb-0">
					This concludes the survey. Please click the submit button below. Thank
					you very much for your cooperation.
					<br />
					We will send you a return email from our store. Thank you for your
					understanding.
				</p>
			</div>
		</>
	);
};

export default StepSurveyShopEvaluationEn;
