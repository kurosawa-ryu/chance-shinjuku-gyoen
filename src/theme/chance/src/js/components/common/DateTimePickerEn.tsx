import SelectFieldEn from "@src/js/components/common/FormFields/SelectFieldEn";
import React from "react";
import { Col, Form, Row } from "react-bootstrap";
import type {
	FieldErrors,
	FieldValues,
	Path,
	UseFormRegister,
	UseFormWatch,
} from "react-hook-form";

type DateTimePickerProps<T extends FieldValues> = {
	register: UseFormRegister<T>;
	watch: UseFormWatch<T>;
	errors: FieldErrors<T>;
	monthFieldName?: string;
	dayFieldName?: string;
	hourFieldName?: string;
	minuteFieldName?: string;
	required?: boolean;
	label?: string;
};

// 月ごとの日数を返す関数
const getDaysInMonth = (month: number): number => {
	if (month < 1 || month > 12) return 31;
	const daysInMonth = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
	return daysInMonth[month - 1];
};

const DateTimePickerEn = <T extends FieldValues>({
	register,
	watch,
	errors,
	monthFieldName = "month",
	dayFieldName = "day",
	hourFieldName = "hour",
	minuteFieldName = "minute",
	required = true,
	label = "Date & Time",
}: DateTimePickerProps<T>) => {
	const selectedMonth = watch(monthFieldName as Path<T>);
	const maxDay = selectedMonth ? getDaysInMonth(Number(selectedMonth)) : 31;
	const hours = Array.from({ length: 12 }, (_, i) => i + 13); // 13時から24時
	const minutes = ["00", "15", "30", "45"];

	const requiredLabel = required ? (
		<span
			className="badge bg-danger ms-2"
			style={{ fontSize: "0.85em", verticalAlign: "middle" }}
		>
			Required
		</span>
	) : null;

	const monthError = errors[monthFieldName];
	const dayError = errors[dayFieldName];
	const hourError = errors[hourFieldName];
	const minuteError = errors[minuteFieldName];

	return (
		<>
			<Form.Label>
				{label} {requiredLabel}
			</Form.Label>
			<Row>
				<Col xs={6} md={3}>
					<SelectFieldEn
						label=""
						name={monthFieldName as Path<T>}
						register={register}
						errors={errors}
						options={[
							{ value: 1, label: "January (1)" },
							{ value: 2, label: "February (2)" },
							{ value: 3, label: "March (3)" },
							{ value: 4, label: "April (4)" },
							{ value: 5, label: "May (5)" },
							{ value: 6, label: "June (6)" },
							{ value: 7, label: "July (7)" },
							{ value: 8, label: "August (8)" },
							{ value: 9, label: "September (9)" },
							{ value: 10, label: "October (10)" },
							{ value: 11, label: "November (11)" },
							{ value: 12, label: "December (12)" },
						]}
						placeholder="Month"
					/>
				</Col>
				<Col xs={6} md={3}>
					<SelectFieldEn
						label=""
						name={dayFieldName as Path<T>}
						register={register}
						errors={errors}
						options={Array.from({ length: maxDay }, (_, i) => ({
							value: i + 1,
							label: `${i + 1}`,
						}))}
						placeholder="Day"
					/>
				</Col>
				<Col xs={6} md={3}>
					<SelectFieldEn
						label=""
						name={hourFieldName as Path<T>}
						register={register}
						errors={errors}
						options={hours.map((hour) => ({ value: hour, label: `${hour}` }))}
						placeholder="Hour"
					/>
				</Col>
				<Col xs={6} md={3}>
					<SelectFieldEn
						label=""
						name={minuteFieldName as Path<T>}
						register={register}
						errors={errors}
						options={minutes.map((minute) => ({
							value: minute,
							label: `:${minute}`,
						}))}
						placeholder="Min"
					/>
				</Col>
			</Row>
		</>
	);
};

export default DateTimePickerEn;
