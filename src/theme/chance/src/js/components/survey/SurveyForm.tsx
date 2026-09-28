import { zodResolver } from "@hookform/resolvers/zod";
import StepIndicator from "@src/js/components/survey/StepIndicator";
import StepSurveyBasicInfo from "@src/js/components/survey/StepSurveyBasicInfo";
import StepSurveyBoyEvaluation from "@src/js/components/survey/StepSurveyBoyEvaluation";
import StepSurveyConfirmation from "@src/js/components/survey/StepSurveyConfirmation";
import StepSurveyShopEvaluation from "@src/js/components/survey/StepSurveyShopEvaluation";
import ThanksPage from "@src/js/components/survey/ThanksPage";
import { useMultiStepForm } from "@src/js/hooks/useMultiStepForm";
import { useQueryParamToForm } from "@src/js/hooks/useQueryParamToForm";
import { type SurveyFormData, surveySchema } from "@src/js/schema/surveySchema";
import axios from "axios";
import React, { useRef, useState } from "react";
import { Alert, Button, Form } from "react-bootstrap";
import { type Path, useForm } from "react-hook-form";

const FORM_ID = "1439"; // Contact Form 7のID（変更が必要）
const ENDPOINT = `/wp-json/contact-form-7/v1/contact-forms/${FORM_ID}/feedback`;
const UNIT_TAG = `wpcf7-f${FORM_ID}-p1-o1`;

// 各ステップでバリデーションするフィールド名を定義
const validationFields: Path<SurveyFormData>[][] = [
	[
		"your-name",
		"your-email",
		"email-confirm",
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

const SurveyForm: React.FC = () => {
	const [isError, setIsError] = useState(false);
	const formRef = useRef<HTMLFormElement | null>(null);

	const {
		register,
		watch,
		handleSubmit,
		trigger,
		getValues,
		setValue,
		formState: { errors, isValid, isSubmitting },
	} = useForm<SurveyFormData>({
		resolver: zodResolver(surveySchema),
		mode: "onChange",
		defaultValues: {
			"your-name": "",
			"your-email": "",
			"email-confirm": "",
			"reservation-month": "",
			"reservation-day": "",
			"reservation-hour": "",
			"reservation-minute": "",
			"course-type": "",
			"course-duration": "",
			"other-course": "",
			"cast-name": "",
			"visit-count": "初めて",
			"cast-review": "",
			"publisibal-cast-review": "公開可",
			"cast-impression": "大変好印象",
			"cast-photo-gap": "想像以上に良かった",
			"cast-language": "とても良かった",
			"cast-service": "",
			"cast-again": "指名する",
			"reception-response": "とても良かった",
			"reception-response-concern": "",
			"website-concern": "とても良かった",
			"system-concern": "とても良かった",
			"price-concern": "とても良かった",
			"other-concern": "",
		},
	});

	// URLクエリパラメータからboyを取得してcast-nameに設定
	useQueryParamToForm("boy", "cast-name", setValue);

	const { currentStep, handleNext, handleBack, goToStep, isFirstStep } =
		useMultiStepForm<SurveyFormData>({
			totalSteps: 5, // 基本情報→ボーイ評価→店舗評価→確認画面→サンクスページ
			trigger,
			validationFields,
		});

	// デバッグ用: フォームの状態を監視
	React.useEffect(() => {
		console.log("現在のステップ:", currentStep);
		console.log("isValid:", isValid);
		console.log("全フォーム値:", getValues());
		console.log("エラー:", errors);
	}, [currentStep, isValid, getValues, errors]);

	const onSubmit = async (data: SurveyFormData) => {
		console.log("送信データ:", data);
		console.log("エンドポイント:", ENDPOINT);

		try {
			// email-confirmは送信しない
			const { "email-confirm": emailConfirm, ...sendData } = data;

			// FormDataオブジェクトを作成
			const formData = new FormData();

			// すべてのフィールドをFormDataに追加
			for (const [key, value] of Object.entries(sendData)) {
				if (value !== undefined && value !== null) {
					// 配列の場合は複数のエントリーとして追加
					if (Array.isArray(value)) {
						for (const item of value) {
							formData.append(`${key}[]`, String(item));
						}
					} else {
						formData.append(key, String(value));
					}
				}
			}

			// Contact Form 7に必要な追加フィールド
			formData.append("_wpcf7_unit_tag", UNIT_TAG);

			console.log("FormDataエントリー:");
			const entries = Array.from(formData.entries());
			for (const [key, value] of entries) {
				console.log(`${key}: ${value}`);
			}

			const response = await axios.post(ENDPOINT, formData, {
				headers: {
					"Content-Type": "multipart/form-data",
				},
			});

			console.log("アンケート回答データ:", response);

			if (response.data?.status === "mail_sent") {
				goToStep(5, "survey-form");
			} else {
				console.error("送信失敗:", response.data);
				setIsError(true);
			}
		} catch (error) {
			console.error("送信エラー:", error);
			if (axios.isAxiosError(error)) {
				console.error("エラーレスポンス:", error.response?.data);
				console.error("エラーステータス:", error.response?.status);
			}
			setIsError(true);
		}
	};

	return (
		<>
			{currentStep === 5 ? (
				<ThanksPage />
			) : (
				<Form
					ref={formRef}
					noValidate
					onSubmit={handleSubmit(onSubmit)}
					className="bg-white rounded shadow-sm p-4 mb-4"
				>
					<StepIndicator currentStep={currentStep} />

					{isError && (
						<Alert variant="danger" className="text-center mb-3" role="alert">
							アンケートの送信中にエラーが発生しました。
							<br />
							お手数ですが再度お試しください。
						</Alert>
					)}

					{currentStep === 1 && (
						<StepSurveyBasicInfo
							register={register}
							watch={watch}
							errors={errors}
						/>
					)}

					{currentStep === 2 && (
						<StepSurveyBoyEvaluation
							register={register}
							watch={watch}
							errors={errors}
						/>
					)}

					{currentStep === 3 && (
						<StepSurveyShopEvaluation
							register={register}
							watch={watch}
							errors={errors}
						/>
					)}

					{currentStep === 4 && (
						<StepSurveyConfirmation
							formData={getValues()}
							onBack={handleBack}
							isSubmitting={isSubmitting}
						/>
					)}

					<div className="d-flex justify-content-between mt-4">
						{!isFirstStep && currentStep < 4 && (
							<Button variant="secondary" onClick={handleBack}>
								戻る
							</Button>
						)}
						{currentStep < 4 && (
							<Button
								variant="primary"
								onClick={() => {
									console.log("次へボタンクリック時の状態:");
									console.log("currentStep:", currentStep);
									console.log("isValid:", isValid);
									console.log("errors:", errors);
									console.log("formValues:", getValues());
									handleNext("survey-form");
								}}
								disabled={false}
							>
								{currentStep === 3 ? "確認画面へ" : "次へ"}
							</Button>
						)}
						{currentStep === 4 && (
							<>
								<Button variant="secondary" onClick={handleBack}>
									戻る
								</Button>
								<Button
									variant="success"
									type="submit"
									disabled={isSubmitting}
									onClick={() => {
										console.log("送信ボタンクリック時の状態:");
										console.log("isValid:", isValid);
										console.log("errors:", errors);
										console.log("formValues:", getValues());
									}}
								>
									{isSubmitting ? "送信中..." : "アンケートを送信する"}
								</Button>
							</>
						)}
					</div>
				</Form>
			)}
		</>
	);
};

export default SurveyForm;
