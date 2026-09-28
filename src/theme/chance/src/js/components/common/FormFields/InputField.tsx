import React from "react";
import { Form } from "react-bootstrap";
import type {
	FieldErrors,
	FieldValues,
	Path,
	UseFormRegister,
} from "react-hook-form";

type InputFieldProps<T extends FieldValues> = {
	label: string;
	name: Path<T>;
	register: UseFormRegister<T>;
	errors: FieldErrors<T>;
	required?: boolean;
	type?: "text" | "email" | "tel" | "password" | "number";
	placeholder?: string;
	disabled?: boolean;
};

const InputField = <T extends FieldValues>({
	label,
	name,
	register,
	errors,
	required = false,
	type = "text",
	placeholder,
	disabled = false,
}: InputFieldProps<T>) => {
	const requiredLabel = required ? (
		<span
			className="badge bg-danger ms-2"
			style={{ fontSize: "0.85em", verticalAlign: "middle" }}
		>
			必須
		</span>
	) : null;
	const error = errors[name];

	return (
		<Form.Group className="mb-3">
			<Form.Label>
				{label} {requiredLabel}
			</Form.Label>
			<Form.Control
				type={type}
				placeholder={placeholder}
				{...register(name)}
				isInvalid={!!error}
				disabled={disabled}
			/>
			{error && (
				<Form.Control.Feedback type="invalid">
					{error.message as string}
				</Form.Control.Feedback>
			)}
		</Form.Group>
	);
};

export default InputField;
