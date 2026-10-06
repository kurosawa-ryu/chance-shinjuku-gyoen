import CheckboxGroupField from "@src/js/components/common/FormFields/CheckboxGroupField";
import RadioGroupField from "@src/js/components/common/FormFields/RadioGroupField";
import TextareaField from "@src/js/components/common/FormFields/TextareaField";
import { SurveyFormData } from "@src/js/schema/surveySchema";
import React from "react";
import { Form } from "react-bootstrap";
import { FieldErrors, UseFormRegister, UseFormWatch } from "react-hook-form";

type StepSurveyBoyEvaluationProps = {
	register: UseFormRegister<SurveyFormData>;
	watch: UseFormWatch<SurveyFormData>;
	errors: FieldErrors<SurveyFormData>;
};

const impressionOptions = {
	VERY_GOOD: "大変好印象",
	GOOD: "良い",
	ACCEPTABLE: "許せる範囲",
	CONSIDERED_CANCEL: "キャンセルを考えた",
} as const;

const photoGapOptions = {
	BETTER_THAN_EXPECTED: "想像以上に良かった",
	ACCEPTABLE: "許せる範囲",
	AS_EXPECTED: "想像通り",
	COMPLETELY_DIFFERENT: "全く写真と違う",
} as const;

const attitudeOptions = {
	VERY_GOOD: "とても良かった",
	GOOD: "良かった",
	NORMAL: "普通",
	BAD: "悪かった",
	VERY_BAD: "とても悪かった",
} as const;

const serviceOptions = {
	NONE: "なし",
	KISS: "キス",
	BACK_TACHI: "バックタチ",
	BACK_UKE: "バックウケ",
	RAW_FELLATIO: "生フェラ",
	OTHER: "その他",
} as const;

const nextNomineeOptions = {
	YES: "指名する",
	NO: "指名しない",
	UNDECIDED: "どちらともいえない",
} as const;

const StepSurveyBoyEvaluation: React.FC<StepSurveyBoyEvaluationProps> = ({
	register,
	watch,
	errors,
}) => {
	return (
		<>
			<Form.Group className="mb-3">
				<TextareaField<SurveyFormData>
					label="ボーイの良かった点、悪かった点、感想等"
					name="cast-review"
					register={register}
					errors={errors}
					rows={5}
					placeholder="ボーイに対する感想をご記入ください"
					maxLength={2000}
					required
				/>
				<div className="mt-2">
					<RadioGroupField<SurveyFormData>
						label=""
						name="publisibal-cast-review"
						register={register}
						errors={errors}
						options={[
							{ value: "公開可", label: "公開可" },
							{ value: "公開不可", label: "公開不可" },
						]}
						required
						defaultValue="公開可"
					/>
					<small className="text-muted">
						上記のレビューの内容を一部スタッフの個人ページに掲載させて頂けるお客様はチェックをいれてください。
						プライベートな個人を特定できる内容は、改訂いたしますが、できる限りそのまま公開いたします。
						ご協力何卒よろしくお願い申し上げます。
					</small>
				</div>
			</Form.Group>

			<RadioGroupField<SurveyFormData>
				label="ボーイと対面した時の第一印象"
				name="cast-impression"
				register={register}
				errors={errors}
				options={Object.entries(impressionOptions).map(([, value]) => ({
					value,
					label: value,
				}))}
				required
				defaultValue={impressionOptions.VERY_GOOD}
			/>

			<RadioGroupField<SurveyFormData>
				label="写真とのギャップ"
				name="cast-photo-gap"
				register={register}
				errors={errors}
				options={Object.entries(photoGapOptions).map(([, value]) => ({
					value,
					label: value,
				}))}
				required
				defaultValue={photoGapOptions.BETTER_THAN_EXPECTED}
			/>

			<RadioGroupField<SurveyFormData>
				label="言葉遣い"
				name="cast-language"
				register={register}
				errors={errors}
				options={Object.entries(attitudeOptions).map(([, value]) => ({
					value,
					label: value,
				}))}
				required
				defaultValue={attitudeOptions.VERY_GOOD}
			/>

			<CheckboxGroupField<SurveyFormData>
				label="して欲しかったのにしてくれなかったサービス（複数選択可）"
				name="cast-service"
				register={register}
				errors={errors}
				watch={watch}
				options={Object.entries(serviceOptions).map(([, value]) => ({
					value,
					label: value,
				}))}
				otherFieldName="cast-service"
				otherOptionValue={serviceOptions.OTHER}
			/>

			<RadioGroupField<SurveyFormData>
				label="今後また今回のボーイを指名しますか？"
				name="cast-again"
				register={register}
				errors={errors}
				options={Object.entries(nextNomineeOptions).map(([, value]) => ({
					value,
					label: value,
				}))}
				required
				defaultValue={nextNomineeOptions.YES}
			/>

			<RadioGroupField<SurveyFormData>
				label="受付の応対"
				name="reception-response"
				register={register}
				errors={errors}
				options={Object.entries(attitudeOptions).map(([, value]) => ({
					value,
					label: value,
				}))}
				required
				defaultValue={attitudeOptions.VERY_GOOD}
			/>
		</>
	);
};

export default StepSurveyBoyEvaluation;
