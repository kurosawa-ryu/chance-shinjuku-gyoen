import React from "react";
import { Form } from "react-bootstrap";
import type {
	FieldErrors,
	FieldValues,
	Path,
	UseFormRegister,
	UseFormWatch,
} from "react-hook-form";

type Option = {
	value: string;
	label: string;
};

type CheckboxGroupFieldProps<T extends FieldValues> = {
	label: string;
	name: Path<T>;
	register: UseFormRegister<T>;
	errors: FieldErrors<T>;
	watch?: UseFormWatch<T>;
	options: Option[];
	required?: boolean;
	inline?: boolean;
	otherFieldName?: Path<T>;
	otherOptionValue?: string;
};

const CheckboxGroupField = <T extends FieldValues>({
	label,
	name,
	register,
	errors,
	watch,
	options,
	required = false,
	inline = false,
	otherFieldName,
	otherOptionValue,
}: CheckboxGroupFieldProps<T>) => {
	const requiredLabel = required ? (
		<span className="text-danger"> ※必須</span>
	) : null;
	const error = errors[name];
	const watchedValue = watch ? watch(name) : undefined;

	const showOtherInput =
		otherFieldName &&
		otherOptionValue &&
		Array.isArray(watchedValue) &&
		(watchedValue as string[]).includes(otherOptionValue);

	return (
		<Form.Group className="mb-3">
			<Form.Label>
				{label} {requiredLabel}
			</Form.Label>
			<div className="checkbox-button-group">
				{options.map((option) => (
					<Form.Check
						key={option.value}
						type="checkbox"
						label={option.label}
						value={option.value}
						id={`${name}-${option.value}`}
						{...register(name)}
						isInvalid={!!error}
						inline={inline}
					/>
				))}
			</div>
			{showOtherInput && otherFieldName && (
				<Form.Control
					type="text"
					placeholder="その他の内容をご記入ください"
					className="mt-2"
					{...register(otherFieldName)}
					isInvalid={!!errors[otherFieldName]}
				/>
			)}
			{error && (
				<Form.Text className="text-danger d-block mt-1">
					{error.message as string}
				</Form.Text>
			)}
			{errors[otherFieldName as string] && (
				<Form.Control.Feedback type="invalid">
					{errors[otherFieldName as string]?.message as string}
				</Form.Control.Feedback>
			)}
		</Form.Group>
	);
};

export default CheckboxGroupField;
