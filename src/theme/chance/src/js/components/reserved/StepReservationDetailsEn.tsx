import DateTimePickerEn from "@src/js/components/common/DateTimePickerEn";
import InputFieldEn from "@src/js/components/common/FormFields/InputFieldEn";
import RadioGroupFieldEn from "@src/js/components/common/FormFields/RadioGroupFieldEn";
import SelectFieldEn from "@src/js/components/common/FormFields/SelectFieldEn";
import TextareaFieldEn from "@src/js/components/common/FormFields/TextareaFieldEn";
import { ReservationFormData } from "@src/js/schema/reservationSchema";
import {
	DurationEn,
	ReservationFormDataEn,
	courseTypesEn,
	dateCombinedOptionsEn,
} from "@src/js/schema/reservationSchemaEn";
import React from "react";
import { FieldErrors, UseFormRegister, UseFormWatch } from "react-hook-form";

type Props = {
	register: UseFormRegister<ReservationFormData>;
	errors: FieldErrors<ReservationFormData>;
	watch: UseFormWatch<ReservationFormData>;
	availableDurations: DurationEn[];
};

const StepReservationDetailsEn: React.FC<Props> = ({
	register,
	errors,
	watch,
	availableDurations,
}) => {
	const courseDuration = watch("course-duration");
	const selectedCourseType = watch("course-type");
	const is3pOrSwap = [
		"3p-60min",
		"3p-90min",
		"3p-120min",
		"swap-90min",
		"swap-120min",
	].includes(courseDuration);
	const isLongCourse = [
		"long-21-9",
		"long-22-9",
		"long-23-9",
		"long-24-9",
	].includes(courseDuration);
	const isDateOnly = selectedCourseType === courseTypesEn.DATE_ONLY;
	const isSwap = ["swap-90min", "swap-120min"].includes(courseDuration);
	const is3p = ["3p-60min", "3p-90min", "3p-120min"].includes(courseDuration);
	const showDateCombined =
		selectedCourseType === courseTypesEn.PRIVATE_ROOM ||
		selectedCourseType === courseTypesEn.DELIVERY;

	return (
		<>
			<SelectFieldEn<ReservationFormData>
				label="Desired Course"
				name="course-type"
				register={register}
				errors={errors}
				options={Object.entries(courseTypesEn).map(([, value]) => ({
					value: value,
					label: value,
				}))}
				placeholder="Select a course"
				required
			/>

			{selectedCourseType === courseTypesEn.OTHER && (
				<InputFieldEn<ReservationFormData>
					label="Other Course"
					name="other-course"
					register={register}
					errors={errors}
					placeholder="Please enter your desired course details"
					required
				/>
			)}

			{selectedCourseType && selectedCourseType !== courseTypesEn.OTHER && (
				<SelectFieldEn<ReservationFormData>
					label="Course Duration"
					name="course-duration"
					register={register}
					errors={errors}
					options={availableDurations}
					placeholder="Select duration"
					required
				/>
			)}

			{showDateCombined && (
				<SelectFieldEn<ReservationFormData>
					label="Date Service Combined"
					name="date-combined"
					register={register}
					errors={errors}
					options={dateCombinedOptionsEn}
					placeholder="None"
				/>
			)}

			<DateTimePickerEn
				register={register}
				watch={watch}
				errors={errors}
				monthFieldName="reservation-month"
				dayFieldName="reservation-day"
				hourFieldName="reservation-hour"
				minuteFieldName="reservation-minute"
				label="Reservation Date & Time"
				required
			/>

			<InputFieldEn<ReservationFormData>
				label="Requested Boy"
				name="cast-name"
				register={register}
				errors={errors}
				placeholder="Please enter the boy's name"
				required
			/>
			{!isDateOnly && (
				<SelectFieldEn<ReservationFormData>
					label="Anal Play"
					name="cast-anal-play"
					register={register}
					errors={errors}
					options={[
						{ value: "none", label: "None" },
						{
							value: "boy-receiving",
							label: "Boy receiving (Customer inserting)",
						},
						{
							value: "boy-inserting",
							label: "Boy inserting (To customer)",
						},
						{ value: "both", label: "Both" },
					]}
					placeholder="Please select"
					required
				/>
			)}
			{(isLongCourse || isDateOnly) && (
				<RadioGroupFieldEn<ReservationFormData>
					label="Meal During Course"
					name="has-meal-during-course"
					register={register}
					errors={errors}
					options={[
						{ value: "yes", label: "Yes" },
						{ value: "no", label: "No" },
					]}
					required
					useButtonStyles
					selectedValue={watch("has-meal-during-course")}
				/>
			)}
			{is3pOrSwap && (
				<>
					<InputFieldEn<ReservationFormData>
						label="Second Boy"
						name="cast2-name"
						register={register}
						errors={errors}
						placeholder="Please enter the second boy's name"
						required
					/>
					{!isDateOnly && (
						<SelectFieldEn<ReservationFormData>
							label="Second Boy's Anal Play"
							name="cast2-anal-play"
							register={register}
							errors={errors}
							options={[
								{ value: "none", label: "None" },
								{
									value: "boy-receiving",
									label: "Boy receiving (Customer inserting)",
								},
								{
									value: "boy-inserting",
									label: "Boy inserting (To customer)",
								},
								{ value: "both", label: "Both" },
							]}
							placeholder="Please select"
							required
						/>
					)}
				</>
			)}

			{selectedCourseType === courseTypesEn.DELIVERY && (
				<InputFieldEn<ReservationFormData>
					label="Delivery Location (Hotel name, address, etc.)"
					name="delivery-location"
					register={register}
					errors={errors}
					placeholder="Please enter delivery location details"
					required
				/>
			)}

			{is3p && (
				<RadioGroupFieldEn<ReservationFormData>
					label="Boy-to-Boy Interaction (+4,000 yen)"
					name="boy-interaction"
					register={register}
					errors={errors}
					options={[
						{ value: "yes", label: "Yes" },
						{ value: "no", label: "No" },
					]}
					required
					useButtonStyles
					selectedValue={watch("boy-interaction")}
				/>
			)}
			<RadioGroupFieldEn<ReservationFormData>
				label="Discount Ticket"
				name="has-discount-ticket"
				register={register}
				errors={errors}
				options={[
					{ value: "yes", label: "Yes" },
					{ value: "no", label: "No" },
				]}
				required
				useButtonStyles
				selectedValue={watch("has-discount-ticket")}
			/>

			<TextareaFieldEn<ReservationFormData>
				label="Play Requests & Inquiries (Optional)"
				name="play-requests"
				register={register}
				errors={errors}
				placeholder="Please enter any specific play requests or special requirements"
			/>
		</>
	);
};

export default StepReservationDetailsEn;
