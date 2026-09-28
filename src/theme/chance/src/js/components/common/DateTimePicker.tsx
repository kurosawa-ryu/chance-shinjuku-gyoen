import SelectField from "@src/js/components/common/FormFields/SelectField";
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

const DateTimePicker = <T extends FieldValues>({
	register,
	watch,
	errors,
	monthFieldName = "month",
	dayFieldName = "day",
	hourFieldName = "hour",
	minuteFieldName = "minute",
	required = true,
	label = "日時",
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
			必須
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
					<SelectField
						label=""
						name={monthFieldName as Path<T>}
						register={register}
						errors={errors}
						options={Array.from({ length: 12 }, (_, i) => ({
							value: i + 1,
							label: `${i + 1}月`,
						}))}
						placeholder="月"
					/>
				</Col>
				<Col xs={6} md={3}>
					<SelectField
						label=""
						name={dayFieldName as Path<T>}
						register={register}
						errors={errors}
						options={Array.from({ length: maxDay }, (_, i) => ({
							value: i + 1,
							label: `${i + 1}日`,
						}))}
						placeholder="日"
					/>
				</Col>
				<Col xs={6} md={3}>
					<SelectField
						label=""
						name={hourFieldName as Path<T>}
						register={register}
						errors={errors}
						options={hours.map((hour) => ({ value: hour, label: `${hour}時` }))}
						placeholder="時"
					/>
				</Col>
				<Col xs={6} md={3}>
					<SelectField
						label=""
						name={minuteFieldName as Path<T>}
						register={register}
						errors={errors}
						options={minutes.map((minute) => ({
							value: minute,
							label: `${minute}分`,
						}))}
						placeholder="分"
					/>
				</Col>
			</Row>
		</>
	);
};

export default DateTimePicker;
