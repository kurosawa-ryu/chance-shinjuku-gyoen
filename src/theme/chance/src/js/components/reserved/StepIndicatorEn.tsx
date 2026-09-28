import React from "react";

type Props = {
	currentStep: number;
};

const StepIndicatorEn: React.FC<Props> = ({ currentStep }) => (
	<div className="text-center mb-4">
		<h4>Reservation Form</h4>
		<div className="d-flex justify-content-center gap-3 mt-2">
			<div className={`step-indicator ${currentStep === 1 ? "active" : ""}`}>
				1. Reservation Details
			</div>
			<div className={`step-indicator ${currentStep === 2 ? "active" : ""}`}>
				2. Customer Information
			</div>
			<div className={`step-indicator ${currentStep === 3 ? "active" : ""}`}>
				3. Confirmation
			</div>
		</div>
	</div>
);

export default StepIndicatorEn;
