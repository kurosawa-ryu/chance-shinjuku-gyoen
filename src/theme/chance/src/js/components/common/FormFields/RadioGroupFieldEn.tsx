import React from "react";
import { Form } from "react-bootstrap";
import { Check } from "react-bootstrap-icons";
import type {
	FieldErrors,
	FieldValues,
	Path,
	UseFormRegister,
} from "react-hook-form";

type Option = {
	value: string;
	label: string;
};

type RadioGroupFieldProps<T extends FieldValues> = {
	label: string;
	name: Path<T>;
	register: UseFormRegister<T>;
	errors: FieldErrors<T>;
	options: Option[];
	required?: boolean;
	inline?: boolean;
	useButtonStyles?: boolean; // ボタン風スタイルを使うかどうかのフラグ
	defaultValue?: string;
	selectedValue?: string; // ★追加: 選択中の値
};

const RadioGroupFieldEn = <T extends FieldValues>({
	label,
	name,
	register,
	errors,
	options,
	required = false,
	inline = false,
	useButtonStyles = false,
	defaultValue,
	selectedValue, // ★追加
}: RadioGroupFieldProps<T>) => {
	const requiredLabel = required ? (
		<span
			className="badge bg-danger ms-2"
			style={{ fontSize: "0.85em", verticalAlign: "middle" }}
		>
			Required
		</span>
	) : null;
	const error = errors[name];

	return (
		<Form.Group className="mb-3">
			<Form.Label>
				{label} {requiredLabel}
			</Form.Label>
			<div className={useButtonStyles ? "radio-button-group" : ""}>
				{options.map((option) =>
					useButtonStyles ? (
						<React.Fragment key={option.value}>
							<input
								type="radio"
								className="btn-check"
								value={option.value}
								{...register(name)}
								id={`${name}-${option.value}`}
								defaultChecked={defaultValue === option.value}
							/>
							<label
								className="btn btn-outline-primary d-flex align-items-center"
								htmlFor={`${name}-${option.value}`}
							>
								{selectedValue === option.value ? (
									<Check size={20} className="me-2" aria-label="選択中" />
								) : (
									<span
										style={{ width: 20, display: "inline-block" }}
										className="me-2"
									/>
								)}
								{option.label}
							</label>
						</React.Fragment>
					) : (
						<Form.Check
							key={option.value}
							type="radio"
							label={option.label}
							value={option.value}
							id={`${name}-${option.value}`}
							{...register(name)}
							isInvalid={!!error}
							inline={inline}
							defaultChecked={defaultValue === option.value}
						/>
					),
				)}
			</div>
			{error && !useButtonStyles && (
				<Form.Control.Feedback type="invalid" style={{ display: "block" }}>
					{error.message as string}
				</Form.Control.Feedback>
			)}
			{error && useButtonStyles && (
				<Form.Text className="text-danger d-block mt-1">
					{error.message as string}
				</Form.Text>
			)}
		</Form.Group>
	);
};

export default RadioGroupFieldEn;
