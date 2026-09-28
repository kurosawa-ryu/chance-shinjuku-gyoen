import { SurveyFormData } from "@src/js/schema/surveySchema";
import React from "react";
import { Card, Table } from "react-bootstrap";

type StepSurveyConfirmationProps = {
	formData: SurveyFormData;
	onBack: () => void;
	isSubmitting: boolean;
};

const StepSurveyConfirmation: React.FC<StepSurveyConfirmationProps> = ({
	formData,
}) => {
	// 配列データを文字列に変換する関数
	const formatValue = (
		value: string | string[] | undefined,
		defaultValue = "",
	): string => {
		if (!value) return defaultValue;
		if (Array.isArray(value)) {
			return value.length > 0 ? value.join(", ") : defaultValue;
		}
		return value;
	};

	// 表示用にデータをグループ化
	const basicInfo = {
		お名前: formData["your-name"] || "",
		メールアドレス: formData["your-email"] || "",
		ご利用日時: `${formData["reservation-month"] || ""}月${formData["reservation-day"] || ""}日 ${formData["reservation-hour"] || ""}:${formData["reservation-minute"] || ""}`,
		ご利用コース: `${formData["course-type"] || ""} ${formData["course-duration"] || ""}`,
		ボーイのお名前: formData["cast-name"] || "",
		利用回数: formData["visit-count"] || "",
	};

	const boyEvaluation = {
		ボーイの評価: formData["cast-review"] || "記入なし",
		第一印象: formData["cast-impression"] || "",
		写真とのギャップ: formData["cast-photo-gap"] || "",
		言葉遣い: formData["cast-language"] || "",
		サービスの不満点: formatValue(formData["cast-service"], "なし"),
		再指名: formData["cast-again"] || "",
		受付の応対: formData["reception-response"] || "",
	};

	const shopEvaluation = {
		接客の気になった点: formatValue(
			formData["reception-response-concern"],
			"なし",
		),
		ウェブサイト評価: formData["website-concern"] || "",
		システム評価: formData["system-concern"] || "",
		料金設定評価: formData["price-concern"] || "",
		ご意見ご要望: formData["other-concern"] || "記入なし",
	};

	const renderDataTable = (data: Record<string, string>) => (
		<Table bordered responsive className="mb-4">
			<tbody>
				{Object.entries(data).map(([key, value]) => (
					<tr key={key}>
						<th className="bg-light text-dark" style={{ width: "35%" }}>
							{key}
						</th>
						<td>{value}</td>
					</tr>
				))}
			</tbody>
		</Table>
	);

	return (
		<div>
			<Card className="mb-4 border-0">
				<Card.Body>
					<Card.Title className="text-center mb-4">入力内容のご確認</Card.Title>

					<h5 className="my-3">基本情報</h5>
					{renderDataTable(basicInfo)}

					<h5 className="my-3">ボーイの評価</h5>
					{renderDataTable(boyEvaluation)}

					<h5 className="my-3">店舗の評価</h5>
					{renderDataTable(shopEvaluation)}
				</Card.Body>
			</Card>
		</div>
	);
};

export default StepSurveyConfirmation;
