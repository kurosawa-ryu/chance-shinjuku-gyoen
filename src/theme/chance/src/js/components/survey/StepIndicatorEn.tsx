import React from "react";

type Props = {
	currentStep: number;
};

const StepIndicatorEn: React.FC<Props> = ({ currentStep }) => {
	return (
		<div className="text-center mb-4">
			<div className="d-flex justify-content-center gap-3 mt-2">
				<div className={`step-indicator ${currentStep === 1 ? "active" : ""}`}>
					1. Basic Information
				</div>
				<div className={`step-indicator ${currentStep === 2 ? "active" : ""}`}>
					2. About the Boy
				</div>
				<div className={`step-indicator ${currentStep === 3 ? "active" : ""}`}>
					3. About the Store
				</div>
				<div className={`step-indicator ${currentStep === 4 ? "active" : ""}`}>
					4. Confirmation
				</div>
			</div>
		</div>
	);
};

export default StepIndicatorEn;
