import { zodResolver } from "@hookform/resolvers/zod";
import DateTimePicker from "@src/js/components/common/DateTimePicker";
import InputField from "@src/js/components/common/FormFields/InputField";
import RadioGroupField from "@src/js/components/common/FormFields/RadioGroupField";
import SelectField from "@src/js/components/common/FormFields/SelectField";
import TextareaField from "@src/js/components/common/FormFields/TextareaField";
import StepRecruitConfirmation from "@src/js/components/recruit/StepRecruitConfirmation";
import StepRecruitIndicator from "@src/js/components/recruit/StepRecruitIndicator";
import ThanksPage from "@src/js/components/recruit/ThanksPage";
import { useMultiStepForm } from "@src/js/hooks/useMultiStepForm";
import { RecruitFormData, recruitSchema } from "@src/js/schema/recruitSchema";
import axios from "axios";
import React, { useState, useRef } from "react";
import { Alert, Button, Form, InputGroup } from "react-bootstrap";
import { type Path, useForm } from "react-hook-form";

const recruitData = (
	window as Window & {
		recruitData?: { nonce?: string; formId?: string };
	}
).recruitData;

const FORM_ID = recruitData?.formId || "110";
const ENDPOINT = `/wp-json/contact-form-7/v1/contact-forms/${FORM_ID}/feedback`;
const UNIT_TAG = `wpcf7-f${FORM_ID}-p1-o1`;

const validationFields: Path<RecruitFormData>[][] = [
	[
		"your-name",
		"your-email",
		"email-confirm",
		"your-tel",
		"interview-month",
		"interview-day",
		"interview-hour",
		"interview-minute",
		"warking-daies",
		"your-highe",
		"your-waigh",
		"your-age",
		"your-dormitory",
		"your-moza",
		"your-experience",
		"your-message",
	],
	[], // 確認画面はバリデーションなし
];

const RecruitForm: React.FC = () => {
	const [isError, setIsError] = useState(false);
	const formRef = useRef<HTMLFormElement | null>(null);
	const {
		register,
		handleSubmit,
		watch,
		trigger,
		formState: { errors, isValid, isSubmitting },
	} = useForm<RecruitFormData>({
		resolver: zodResolver(recruitSchema),
		mode: "onChange",
		defaultValues: {
			"your-dormitory": "希望しない",
			"your-moza": "希望しない",
			"your-experience": "無し",
		},
	});

	const { currentStep, handleNext, handleBack, goToStep, isFirstStep } =
		useMultiStepForm<RecruitFormData>({
			totalSteps: 3,
			trigger,
			validationFields,
		});

	// useEffect(() => {
	// 	if (formRef.current) {
	// 		formRef.current.scrollIntoView({ behavior: "smooth" });
	// 	}
	// }, []);

	const onSubmit = async (data: RecruitFormData) => {
		try {
			const { "email-confirm": _emailConfirm, ...rest } = data;
			const formData = new FormData();

			for (const [key, value] of Object.entries(rest)) {
				if (value !== undefined && value !== null && value !== "") {
					formData.append(key, String(value));
				}
			}

			formData.append("_wpcf7_unit_tag", UNIT_TAG);

			const headers: Record<string, string> = {};
			if (recruitData?.nonce) {
				headers["X-WP-Nonce"] = recruitData.nonce;
			}

			const response = await axios.post(ENDPOINT, formData, { headers });

			if (response.data?.status === "mail_sent") {
				goToStep(3, "recruit-form");
			} else {
				console.error("応募送信失敗:", response.data);
				setIsError(true);
			}
		} catch (error) {
			console.error("応募送信エラー:", error);
			setIsError(true);
		}
	};

	return (
		<Form
			ref={formRef}
			noValidate
			onSubmit={handleSubmit(onSubmit)}
			className="recruit-form p-4"
		>
			<StepRecruitIndicator currentStep={currentStep} />
			{isError && (
				<Alert variant="danger" className="text-center mb-3" role="alert">
					応募の送信中にエラーが発生しました。
					<br />
					お手数ですが再度お試しください。
				</Alert>
			)}
			{currentStep === 1 && (
				<>
					<InputField<RecruitFormData>
						label="氏名"
						name="your-name"
						register={register}
						errors={errors}
						required={true}
					/>
					<InputField<RecruitFormData>
						label="メールアドレス"
						name="your-email"
						type="email"
						register={register}
						errors={errors}
						required={true}
					/>
					<InputField<RecruitFormData>
						label="メールアドレス (確認用)"
						name="email-confirm"
						type="email"
						register={register}
						errors={errors}
						required={true}
					/>
					<InputField<RecruitFormData>
						label="電話番号"
						name="your-tel"
						type="tel"
						register={register}
						errors={errors}
						required={true}
					/>
					<DateTimePicker
						label="面接希望日時"
						register={register}
						watch={watch}
						errors={errors}
						required={true}
						monthFieldName="interview-month"
						dayFieldName="interview-day"
						hourFieldName="interview-hour"
						minuteFieldName="interview-minute"
					/>
					<SelectField<RecruitFormData>
						label="１週間の出勤希望日数"
						name="warking-daies"
						register={register}
						errors={errors}
						options={[
							{ value: "1", label: "1日" },
							{ value: "2", label: "2日" },
							{ value: "3", label: "3日" },
							{ value: "4", label: "4日" },
							{ value: "5", label: "5日" },
							{ value: "6", label: "6日" },
							{ value: "7", label: "7日" },
						]}
						placeholder="選択してください"
						required={true}
					/>
					<Form.Group className="mb-3">
						<Form.Label>
							身長{" "}
							<span
								className="badge bg-danger ms-2"
								style={{ fontSize: "0.85em", verticalAlign: "middle" }}
							>
								必須
							</span>
						</Form.Label>
						<InputGroup>
							<Form.Control
								type="number"
								placeholder="例: 172"
								{...register("your-highe")}
								isInvalid={!!errors["your-highe"]}
							/>
							<InputGroup.Text>cm</InputGroup.Text>
							{errors["your-highe"] && (
								<Form.Control.Feedback type="invalid">
									{errors["your-highe"].message}
								</Form.Control.Feedback>
							)}
						</InputGroup>
					</Form.Group>
					<Form.Group className="mb-3">
						<Form.Label>
							体重{" "}
							<span
								className="badge bg-danger ms-2"
								style={{ fontSize: "0.85em", verticalAlign: "middle" }}
							>
								必須
							</span>
						</Form.Label>
						<InputGroup>
							<Form.Control
								type="number"
								placeholder="例: 55"
								{...register("your-waigh")}
								isInvalid={!!errors["your-waigh"]}
							/>
							<InputGroup.Text>kg</InputGroup.Text>
							{errors["your-waigh"] && (
								<Form.Control.Feedback type="invalid">
									{errors["your-waigh"].message}
								</Form.Control.Feedback>
							)}
						</InputGroup>
					</Form.Group>
					<Form.Group className="mb-3">
						<Form.Label>
							年齢{" "}
							<span
								className="badge bg-danger ms-2"
								style={{ fontSize: "0.85em", verticalAlign: "middle" }}
							>
								必須
							</span>
						</Form.Label>
						<InputGroup>
							<Form.Control
								type="number"
								placeholder="例: 19"
								{...register("your-age")}
								isInvalid={!!errors["your-age"]}
							/>
							<InputGroup.Text>歳</InputGroup.Text>
							{errors["your-age"] && (
								<Form.Control.Feedback type="invalid">
									{errors["your-age"].message}
								</Form.Control.Feedback>
							)}
						</InputGroup>
					</Form.Group>
					<RadioGroupField<RecruitFormData>
						label="寮の希望有無"
						name="your-dormitory"
						options={[
							{ value: "希望しない", label: "希望しない" },
							{ value: "希望する", label: "希望する" },
						]}
						register={register}
						errors={errors}
						required={true}
						useButtonStyles
						selectedValue={watch("your-dormitory")}
					/>
					<RadioGroupField<RecruitFormData>
						label="掲載画像のモザイク希望有無"
						name="your-moza"
						options={[
							{ value: "希望しない", label: "希望しない" },
							{ value: "希望する", label: "希望する" },
						]}
						register={register}
						errors={errors}
						required={true}
						useButtonStyles
						selectedValue={watch("your-moza")}
					/>
					<RadioGroupField<RecruitFormData>
						label="他店での勤務経験"
						name="your-experience"
						options={[
							{ value: "無し", label: "無し" },
							{ value: "有り", label: "有り" },
						]}
						register={register}
						errors={errors}
						required={true}
						useButtonStyles
						selectedValue={watch("your-experience")}
					/>
					<TextareaField<RecruitFormData>
						label="その他希望、質問等"
						name="your-message"
						register={register}
						errors={errors}
						rows={5}
						placeholder="ご自由にご記入ください"
					/>
				</>
			)}
			{currentStep === 2 && <StepRecruitConfirmation watch={watch} />}
			{currentStep === 3 && <ThanksPage />}
			<div className="d-flex flex-column gap-2 justify-content-center align-items-center mt-4">
				{!isFirstStep && currentStep < 3 && (
					<Button
						variant="secondary"
						onClick={handleBack}
						className="w-50 mx-auto"
					>
						戻る
					</Button>
				)}
				{currentStep < 2 && (
					<Button
						variant="primary"
						onClick={() => handleNext("recruit-form")}
						className="w-50 mx-auto"
					>
						次へ
					</Button>
				)}
				{currentStep === 2 && (
					<Button
						variant="success"
						type="submit"
						disabled={!isValid || isSubmitting}
						className="w-50 mx-auto"
					>
						送信する
					</Button>
				)}
			</div>
		</Form>
	);
};

export default RecruitForm;
