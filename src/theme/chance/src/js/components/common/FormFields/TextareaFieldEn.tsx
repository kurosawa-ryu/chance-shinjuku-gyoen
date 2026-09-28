import React from "react";
import { Form } from "react-bootstrap";
import type {
	FieldErrors,
	FieldValues,
	Path,
	UseFormRegister,
} from "react-hook-form";

type TextareaFieldProps<T extends FieldValues> = {
	label: string;
	name: Path<T>;
	register: UseFormRegister<T>;
	errors: FieldErrors<T>;
	required?: boolean;
	rows?: number;
	placeholder?: string;
};

const TextareaFieldEn = <T extends FieldValues>({
	label,
	name,
	register,
	errors,
	required = false,
	rows = 3,
	placeholder,
}: TextareaFieldProps<T>) => {
	const requiredLabel = required ? (
		<span className="text-danger"> *Required</span>
	) : null;
	const error = errors[name];

	return (
		<Form.Group className="mb-3">
			<Form.Label>
				{label} {requiredLabel}
			</Form.Label>
			<Form.Control
				as="textarea"
				rows={rows}
				placeholder={placeholder}
				{...register(name)}
				isInvalid={!!error}
			/>
			{error && (
				<Form.Control.Feedback type="invalid">
					{error.message as string}
				</Form.Control.Feedback>
			)}
		</Form.Group>
	);
};

export default TextareaFieldEn;
