import CheckboxGroupField from "@src/js/components/common/FormFields/CheckboxGroupField";
import RadioGroupField from "@src/js/components/common/FormFields/RadioGroupField";
import TextareaField from "@src/js/components/common/FormFields/TextareaField";
import { SurveyFormData } from "@src/js/schema/surveySchema";
import React from "react";
import { FieldErrors, UseFormRegister, UseFormWatch } from "react-hook-form";

type StepSurveyShopEvaluationProps = {
	register: UseFormRegister<SurveyFormData>;
	watch: UseFormWatch<SurveyFormData>;
	errors: FieldErrors<SurveyFormData>;
};

const attitudeOptions = {
	VERY_GOOD: "とても良かった",
	GOOD: "良かった",
	NORMAL: "普通",
	BAD: "悪かった",
	VERY_BAD: "とても悪かった",
} as const;

const shopServiceOptions = {
	NONE: "なし",
	FAST_TALKING: "早口",
	QUIET_VOICE: "声が小さい",
	HARD_TO_HEAR: "聞き取りにくい",
	BAD_EXPLANATION: "説明が下手",
	AGGRESSIVE: "威圧的",
	BUSINESSLIKE: "事務的",
	FRIVOLOUS: "軽々しい",
} as const;

const StepSurveyShopEvaluation: React.FC<StepSurveyShopEvaluationProps> = ({
	register,
	watch,
	errors,
}) => {
	return (
		<>
			<CheckboxGroupField<SurveyFormData>
				label="電話の応対や接客で気になったところ（複数選択可）"
				name="reception-response-concern"
				register={register}
				errors={errors}
				options={Object.entries(shopServiceOptions).map(([, value]) => ({
					value,
					label: value,
				}))}
			/>

			<RadioGroupField<SurveyFormData>
				label="当店のウェブサイトはどうでしたか？"
				name="website-concern"
				register={register}
				errors={errors}
				options={Object.entries(attitudeOptions).map(([, value]) => ({
					value,
					label: value,
				}))}
				required
				defaultValue={attitudeOptions.VERY_GOOD}
			/>

			<RadioGroupField<SurveyFormData>
				label="当店のシステムついてはいかがですか？"
				name="system-concern"
				register={register}
				errors={errors}
				options={Object.entries(attitudeOptions).map(([, value]) => ({
					value,
					label: value,
				}))}
				required
				defaultValue={attitudeOptions.VERY_GOOD}
			/>

			<RadioGroupField<SurveyFormData>
				label="料金設定はいかがですか？"
				name="price-concern"
				register={register}
				errors={errors}
				options={Object.entries(attitudeOptions).map(([, value]) => ({
					value,
					label: value,
				}))}
				required
				defaultValue={attitudeOptions.VERY_GOOD}
			/>

			<TextareaField<SurveyFormData>
				label="当店へのご意見ご要望等何でもご記入ください。"
				name="other-concern"
				register={register}
				errors={errors}
				rows={5}
				placeholder="ご意見・ご要望をご記入ください"
			/>

			<div className="mb-4">
				<p className="mb-0">
					以上でアンケートは終了でございます。下記の送信ボタンをクリックしてください。ご協力誠にありがとうございました。
					<br />
					当店から折り返しメールをお送りいたします。よろしくお願い申し上げます。
				</p>
			</div>
		</>
	);
};

export default StepSurveyShopEvaluation;
