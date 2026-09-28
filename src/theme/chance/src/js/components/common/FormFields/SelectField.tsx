import React from "react";
import { Form } from "react-bootstrap";
import type {
	FieldErrors,
	FieldValues,
	Path,
	UseFormRegister,
} from "react-hook-form";

type Option = {
	value: string | number;
	label: string;
};

type SelectFieldProps<T extends FieldValues> = {
	label: string;
	name: Path<T>;
	register: UseFormRegister<T>;
	errors: FieldErrors<T>;
	options: Option[];
	required?: boolean;
	placeholder?: string;
	disabled?: boolean;
};

const SelectField = <T extends FieldValues>({
	label,
	name,
	register,
	errors,
	options,
	required = false,
	placeholder,
	disabled = false,
}: SelectFieldProps<T>) => {
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
			<Form.Select {...register(name)} isInvalid={!!error} disabled={disabled}>
				{placeholder && <option value="">{placeholder}</option>}
				{options.map((option) => (
					<option key={option.value} value={option.value}>
						{option.label}
					</option>
				))}
			</Form.Select>
			{error && (
				<Form.Control.Feedback type="invalid">
					{error.message as string}
				</Form.Control.Feedback>
			)}
		</Form.Group>
	);
};

export default SelectField;
