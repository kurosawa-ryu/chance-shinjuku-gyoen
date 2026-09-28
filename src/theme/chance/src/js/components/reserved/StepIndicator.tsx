import React from "react";

type Props = {
	currentStep: number;
};

const StepIndicator: React.FC<Props> = ({ currentStep }) => (
	<div className="text-center mb-4">
		<h4>予約フォーム</h4>
		<div className="d-flex justify-content-center gap-3 mt-2">
			<div className={`step-indicator ${currentStep === 1 ? "active" : ""}`}>
				1. 予約内容
			</div>
			<div className={`step-indicator ${currentStep === 2 ? "active" : ""}`}>
				2. お客様情報
			</div>
			<div className={`step-indicator ${currentStep === 3 ? "active" : ""}`}>
				3. 確認
			</div>
		</div>
	</div>
);

export default StepIndicator;
