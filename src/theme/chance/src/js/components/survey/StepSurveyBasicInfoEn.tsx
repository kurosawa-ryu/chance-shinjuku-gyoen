import DateTimePickerEn from "@src/js/components/common/DateTimePickerEn";
import InputFieldEn from "@src/js/components/common/FormFields/InputFieldEn";
import RadioGroupFieldEn from "@src/js/components/common/FormFields/RadioGroupFieldEn";
import SelectFieldEn from "@src/js/components/common/FormFields/SelectFieldEn";
import {
	SurveyFormDataEn,
	courseDurationsEn,
	courseTypesEn,
} from "@src/js/schema/surveySchemaEn";
import React from "react";
import { Col, Form, Row } from "react-bootstrap";
import { FieldErrors, UseFormRegister, UseFormWatch } from "react-hook-form";

type StepSurveyBasicInfoEnProps = {
	register: UseFormRegister<SurveyFormDataEn>;
	watch: UseFormWatch<SurveyFormDataEn>;
	errors: FieldErrors<SurveyFormDataEn>;
};

const StepSurveyBasicInfoEn: React.FC<StepSurveyBasicInfoEnProps> = ({
	register,
	watch,
	errors,
}) => {
	const selectedCourseType = watch("course-type");

	const selectedCourseTypeKey = Object.entries(courseTypesEn).find(
		([, value]) => value === selectedCourseType,
	)?.[0] as keyof typeof courseDurationsEn | undefined;

	const courseDurationOptions = selectedCourseTypeKey
		? courseDurationsEn[selectedCourseTypeKey] || []
		: [];
	return (
		<>
			<InputFieldEn<SurveyFormDataEn>
				label="Customer Name"
				name="your-name"
				register={register}
				errors={errors}
				placeholder="Please enter your name"
				required
			/>

			<InputFieldEn<SurveyFormDataEn>
				label="Email Address"
				name="your-email"
				register={register}
				errors={errors}
				type="email"
				placeholder="example@email.com"
				required
			/>

			<DateTimePickerEn
				register={register}
				watch={watch}
				errors={errors}
				label="Service Date & Time"
				monthFieldName="reservation-month"
				dayFieldName="reservation-day"
				hourFieldName="reservation-hour"
				minuteFieldName="reservation-minute"
				required
			/>

			<Form.Group className="mb-3">
				<Form.Label>
					Service Course <span className="text-danger">*Required</span>
				</Form.Label>
				<Row>
					<Col xs={6}>
						<SelectFieldEn<SurveyFormDataEn>
							label=""
							name="course-type"
							register={register}
							errors={errors}
							options={Object.entries(courseTypesEn).map(([, value]) => ({
								value,
								label: value,
							}))}
							placeholder="Please select"
							required
						/>
					</Col>
					<Col xs={6}>
						<SelectFieldEn<SurveyFormDataEn>
							label=""
							name="course-duration"
							register={register}
							errors={errors}
							options={courseDurationOptions}
							placeholder="Please select"
							required
						/>
					</Col>
				</Row>
			</Form.Group>

			{watch("course-duration") === "Other" && (
				<InputFieldEn<SurveyFormDataEn>
					label="Other Course Details"
					name="other-course"
					register={register}
					errors={errors}
					placeholder="Please describe the course details"
				/>
			)}

			<InputFieldEn<SurveyFormDataEn>
				label="Name of the Boy You Selected"
				name="cast-name"
				register={register}
				errors={errors}
				placeholder="Please enter the boy's name"
				required
			/>

			<RadioGroupFieldEn<SurveyFormDataEn>
				label="Number of Times You've Visited Our Store"
				name="visit-count"
				register={register}
				errors={errors}
				options={[
					{ value: "First time", label: "First time" },
					{ value: "2nd time", label: "2nd time" },
					{ value: "3rd time or more", label: "3rd time or more" },
				]}
				required
				inline
				defaultValue="First time"
			/>
		</>
	);
};

export default StepSurveyBasicInfoEn;
