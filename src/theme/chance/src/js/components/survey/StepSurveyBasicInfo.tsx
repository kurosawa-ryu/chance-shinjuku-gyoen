import DateTimePicker from "@src/js/components/common/DateTimePicker";
import InputField from "@src/js/components/common/FormFields/InputField";
import RadioGroupField from "@src/js/components/common/FormFields/RadioGroupField";
import SelectField from "@src/js/components/common/FormFields/SelectField";
import {
	SurveyFormData,
	courseDurations,
	courseTypes,
} from "@src/js/schema/surveySchema";
import React from "react";
import { Col, Form, Row } from "react-bootstrap";
import { FieldErrors, UseFormRegister, UseFormWatch } from "react-hook-form";

type StepSurveyBasicInfoProps = {
	register: UseFormRegister<SurveyFormData>;
	watch: UseFormWatch<SurveyFormData>;
	errors: FieldErrors<SurveyFormData>;
};

const StepSurveyBasicInfo: React.FC<StepSurveyBasicInfoProps> = ({
	register,
	watch,
	errors,
}) => {
	const selectedCourseType = watch("course-type");

	// コースタイプに応じた時間の選択肢を取得
	const getDurationOptions = () => {
		if (!selectedCourseType) return [];

		switch (selectedCourseType) {
			case courseTypes.PRIVATE_ROOM:
				return courseDurations.PRIVATE_ROOM;
			case courseTypes.DELIVERY:
				return courseDurations.DELIVERY;
			case courseTypes.DATE_ONLY:
				return courseDurations.DATE_ONLY;
			default:
				return [];
		}
	};

	return (
		<>
			<InputField<SurveyFormData>
				label="お客様のお名前"
				name="your-name"
				register={register}
				errors={errors}
				placeholder="お名前を入力してください"
				required
			/>

			<InputField<SurveyFormData>
				label="メールアドレス"
				name="your-email"
				register={register}
				errors={errors}
				type="email"
				placeholder="example@email.com"
				required
			/>

			<InputField<SurveyFormData>
				label="メールアドレス（確認）"
				name="email-confirm"
				register={register}
				errors={errors}
				type="email"
				placeholder="上記と同じメールアドレスを入力してください"
				required
			/>

			<DateTimePicker
				register={register}
				watch={watch}
				errors={errors}
				label="ご利用日時"
				monthFieldName="reservation-month"
				dayFieldName="reservation-day"
				hourFieldName="reservation-hour"
				minuteFieldName="reservation-minute"
				required
			/>

			<Form.Group className="mb-3">
				<Form.Label>ご利用コース</Form.Label>
				<Row>
					<Col xs={6}>
						<SelectField<SurveyFormData>
							label=""
							name="course-type"
							register={register}
							errors={errors}
							options={Object.entries(courseTypes).map(([, value]) => ({
								value,
								label: value,
							}))}
							placeholder="選択してください"
							required
						/>
					</Col>
					<Col xs={6}>
						<SelectField<SurveyFormData>
							label=""
							name="course-duration"
							register={register}
							errors={errors}
							options={
								selectedCourseType === courseTypes.OTHER
									? [{ value: "その他", label: "その他" }]
									: [...getDurationOptions()]
							}
							placeholder="選択してください"
							required
						/>
					</Col>
				</Row>
			</Form.Group>

			{(watch("course-duration") === "その他" ||
				watch("course-type") === courseTypes.OTHER) && (
				<InputField<SurveyFormData>
					label="その他のコース内容"
					name="other-course"
					register={register}
					errors={errors}
					placeholder="コース内容をご記入ください"
					required={watch("course-type") === courseTypes.OTHER}
				/>
			)}

			<InputField<SurveyFormData>
				label="ご指名いただいたボーイのお名前"
				name="cast-name"
				register={register}
				errors={errors}
				placeholder="ボーイの名前を入力してください"
				required
			/>

			<RadioGroupField<SurveyFormData>
				label="当店の利用回数"
				name="visit-count"
				register={register}
				errors={errors}
				options={[
					{ value: "初めて", label: "初めて" },
					{ value: "2回目", label: "2回目" },
					{ value: "3回目以上", label: "3回目以上" },
				]}
				required
				inline
				defaultValue="初めて"
			/>
		</>
	);
};

export default StepSurveyBasicInfo;
