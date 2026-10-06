import RadioGroupFieldEn from "@src/js/components/common/FormFields/RadioGroupFieldEn";
import TextareaFieldEn from "@src/js/components/common/FormFields/TextareaFieldEn";
import { SurveyFormDataEn } from "@src/js/schema/surveySchemaEn";
import React from "react";
import { Form } from "react-bootstrap";
import { FieldErrors, UseFormRegister, UseFormWatch } from "react-hook-form";

type StepSurveyBoyEvaluationEnProps = {
	register: UseFormRegister<SurveyFormDataEn>;
	watch: UseFormWatch<SurveyFormDataEn>;
	errors: FieldErrors<SurveyFormDataEn>;
};

const impressionOptionsEn = {
	VERY_GOOD: "Very positive",
	GOOD: "Good",
	ACCEPTABLE: "Acceptable",
	CONSIDERED_CANCEL: "Considered canceling",
} as const;

const photoGapOptionsEn = {
	BETTER_THAN_EXPECTED: "Better than expected",
	ACCEPTABLE: "Acceptable",
	AS_EXPECTED: "As expected",
	COMPLETELY_DIFFERENT: "Completely different from photo",
} as const;

const attitudeOptionsEn = {
	VERY_GOOD: "Very good",
	GOOD: "Good",
	NORMAL: "Normal",
	BAD: "Bad",
	VERY_BAD: "Very bad",
} as const;

const serviceOptionsEn = {
	NONE: "None",
	KISS: "Kiss",
	BACK_TACHI: "Back Tachi",
	BACK_UKE: "Back Uke",
	RAW_FELLATIO: "Raw Fellatio",
	OTHER: "Other",
} as const;

const nextNomineeOptionsEn = {
	YES: "Would book again",
	NO: "Would not book again",
	UNDECIDED: "Undecided",
} as const;

const StepSurveyBoyEvaluationEn: React.FC<StepSurveyBoyEvaluationEnProps> = ({
	register,
	watch,
	errors,
}) => {
	return (
		<>
			<Form.Group className="mb-3">
				<TextareaFieldEn<SurveyFormDataEn>
					label="Comments about the boy (good points, bad points, impressions, etc.)"
					name="cast-review"
					register={register}
					errors={errors}
					rows={5}
					placeholder="Please share your feedback about the boy"
					maxLength={2000}
					required
				/>
				<div className="mt-2">
					<RadioGroupFieldEn<SurveyFormDataEn>
						label=""
						name="publisibal-cast-review"
						register={register}
						errors={errors}
						options={[
							{ value: "Can be published", label: "Can be published" },
							{ value: "Cannot be published", label: "Cannot be published" },
						]}
						required
						defaultValue="Can be published"
					/>
					<small className="text-muted">
						If you allow us to publish part of your review on the staff's
						personal page, please check this option. We may edit private or
						personally identifiable content, but will publish as much as
						possible as is. Thank you for your cooperation.
					</small>
				</div>
			</Form.Group>

			<RadioGroupFieldEn<SurveyFormDataEn>
				label="First impression when meeting the boy"
				name="cast-impression"
				register={register}
				errors={errors}
				options={Object.entries(impressionOptionsEn).map(([, value]) => ({
					value,
					label: value,
				}))}
				required
				defaultValue={impressionOptionsEn.VERY_GOOD}
			/>

			<RadioGroupFieldEn<SurveyFormDataEn>
				label="Gap between photo and reality"
				name="cast-photo-gap"
				register={register}
				errors={errors}
				options={Object.entries(photoGapOptionsEn).map(([, value]) => ({
					value,
					label: value,
				}))}
				required
				defaultValue={photoGapOptionsEn.BETTER_THAN_EXPECTED}
			/>

			<RadioGroupFieldEn<SurveyFormDataEn>
				label="Language/Communication skills"
				name="cast-language"
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
				label="Services you wanted but didn't receive"
				name="cast-service"
				register={register}
				errors={errors}
				rows={3}
				placeholder="Please describe any services you wanted but didn't receive"
			/>

			<RadioGroupFieldEn<SurveyFormDataEn>
				label="Would you book this boy again in the future?"
				name="cast-again"
				register={register}
				errors={errors}
				options={Object.entries(nextNomineeOptionsEn).map(([, value]) => ({
					value,
					label: value,
				}))}
				required
				defaultValue={nextNomineeOptionsEn.YES}
			/>

			<RadioGroupFieldEn<SurveyFormDataEn>
				label="Reception service"
				name="reception-response"
				register={register}
				errors={errors}
				options={Object.entries(attitudeOptionsEn).map(([, value]) => ({
					value,
					label: value,
				}))}
				required
				defaultValue={attitudeOptionsEn.VERY_GOOD}
			/>
		</>
	);
};

export default StepSurveyBoyEvaluationEn;
