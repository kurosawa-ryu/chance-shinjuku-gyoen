import { useState } from "react";
import type { FieldValues, Path, UseFormTrigger } from "react-hook-form";

type UseMultiStepFormProps<T extends FieldValues> = {
	initialStep?: number;
	totalSteps: number;
	trigger: UseFormTrigger<T>;
	validationFields: Path<T>[][]; // 各ステップでバリデーションするフィールド名の配列の配列
};

export function useMultiStepForm<T extends FieldValues>({
	initialStep = 1,
	totalSteps,
	trigger,
	validationFields,
}: UseMultiStepFormProps<T>) {
	const [currentStep, setCurrentStep] = useState(initialStep);

	const handleNext = async (scrollPositionId?: string) => {
		const currentValidationFields = validationFields[currentStep - 1];
		if (currentValidationFields && currentStep < totalSteps) {
			const isStepValid = await trigger(currentValidationFields);
			if (isStepValid) {
				setCurrentStep((prev) => prev + 1);
				if (scrollPositionId) {
					const scrollPosition = document.getElementById(scrollPositionId);
					if (scrollPosition) {
						scrollPosition.scrollIntoView({ behavior: "smooth" });
					}
				} else {
					window.scrollTo(0, 0);
				}
			}
		} else if (currentStep < totalSteps) {
			// バリデーションフィールドがない場合はそのまま進む
			setCurrentStep((prev) => prev + 1);
			window.scrollTo(0, 0);
		}
	};

	const handleBack = () => {
		if (currentStep > 1) {
			setCurrentStep((prev) => prev - 1);
			window.scrollTo(0, 0);
		}
	};

	const goToStep = (step: number, scrollPositionId?: string) => {
		if (step >= 1 && step <= totalSteps) {
			setCurrentStep(step);
			if (scrollPositionId) {
				const scrollPosition = document.getElementById(scrollPositionId);
				if (scrollPosition) {
					scrollPosition.scrollIntoView({ behavior: "smooth" });
				}
			} else {
				window.scrollTo(0, 0);
			}
		}
	};

	return {
		currentStep,
		handleNext,
		handleBack,
		goToStep,
		isFirstStep: currentStep === 1,
		isLastStep: currentStep === totalSteps,
	};
}
