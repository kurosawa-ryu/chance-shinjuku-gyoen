import { SurveyFormDataEn } from "@src/js/schema/surveySchemaEn";
import React from "react";
import { Button, Card, Table } from "react-bootstrap";

type StepSurveyConfirmationEnProps = {
	formData: SurveyFormDataEn;
	onBack: () => void;
	onSubmit: () => void;
	isSubmitting: boolean;
};

const StepSurveyConfirmationEn: React.FC<StepSurveyConfirmationEnProps> = ({
	formData,
	onBack,
	onSubmit,
	isSubmitting,
}) => {
	// Group data for display
	const basicInfo = {
		"Your Name": formData["your-name"] || "",
		"Email Address": formData["your-email"] || "",
		"Service Date & Time": `${formData["reservation-month"] || ""} ${formData["reservation-day"] || ""}, ${formData["reservation-hour"] || ""}:${formData["reservation-minute"] || ""}`,
		"Service Course": `${formData["course-type"] || ""} ${formData["course-duration"] || ""}`,
		"Boy's Name": formData["cast-name"] || "",
		"Visit Count": formData["visit-count"] || "",
	};

	const boyEvaluation = {
		"Boy Review": formData["cast-review"] || "No comments",
		"Review Publication": formData["publisibal-cast-review"] || "",
		"First Impression": formData["cast-impression"] || "",
		"Photo Gap": formData["cast-photo-gap"] || "",
		"Language Skills": formData["cast-language"] || "",
		"Service Concerns": formData["cast-service"] || "None",
		"Would Book Again": formData["cast-again"] || "",
		"Reception Service": formData["reception-response"] || "",
	};

	const shopEvaluation = {
		"Service Concerns": formData["reception-response-concern"] || "None",
		"Website Evaluation": formData["website-concern"] || "",
		"System Evaluation": formData["system-concern"] || "",
		"Pricing Evaluation": formData["price-concern"] || "",
		"Opinions & Requests": formData["other-concern"] || "No comments",
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
					<Card.Title className="text-center mb-4">
						Confirmation of Your Input
					</Card.Title>

					<h5 className="my-3">Basic Information</h5>
					{renderDataTable(basicInfo)}

					<h5 className="my-3">Boy Evaluation</h5>
					{renderDataTable(boyEvaluation)}

					<h5 className="my-3">Store Evaluation</h5>
					{renderDataTable(shopEvaluation)}

					<div className="d-flex justify-content-between mt-4">
						<Button
							variant="secondary"
							onClick={onBack}
							disabled={isSubmitting}
						>
							Back
						</Button>
						<Button
							variant="primary"
							onClick={onSubmit}
							disabled={isSubmitting}
						>
							{isSubmitting ? "Submitting..." : "Submit Survey"}
						</Button>
					</div>
				</Card.Body>
			</Card>
		</div>
	);
};

export default StepSurveyConfirmationEn;
