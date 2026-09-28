import React from "react";

type Props = {
	currentStep: number;
};

const StepIndicator: React.FC<Props> = ({ currentStep }) => {
	return (
		<div className="text-center mb-4">
			<div className="d-flex justify-content-center gap-3 mt-2">
				<div className={`step-indicator ${currentStep === 1 ? "active" : ""}`}>
					1. 基本情報
				</div>
				<div className={`step-indicator ${currentStep === 2 ? "active" : ""}`}>
					2. ボーイについて
				</div>
				<div className={`step-indicator ${currentStep === 3 ? "active" : ""}`}>
					3. 店舗について
				</div>
				<div className={`step-indicator ${currentStep === 4 ? "active" : ""}`}>
					4. 確認
				</div>
			</div>
		</div>
	);
};

export default StepIndicator;
