import React from "react";

type StepRecruitIndicatorProps = {
	currentStep: number;
};

const StepRecruitIndicator: React.FC<StepRecruitIndicatorProps> = ({
	currentStep,
}) => (
	<div className="text-center mb-4">
		<h4>求人応募フォーム</h4>
		<div className="d-flex justify-content-center gap-3 mt-2">
			<div className={`step-indicator ${currentStep === 1 ? "active" : ""}`}>
				1. 応募内容
			</div>
			<div className={`step-indicator ${currentStep === 2 ? "active" : ""}`}>
				2. 確認
			</div>
			<div className={`step-indicator ${currentStep === 3 ? "active" : ""}`}>
				3. 完了
			</div>
		</div>
	</div>
);

export default StepRecruitIndicator;
