import DateTimePicker from "@src/js/components/common/DateTimePicker";
import InputField from "@src/js/components/common/FormFields/InputField";
import RadioGroupField from "@src/js/components/common/FormFields/RadioGroupField";
import SelectField from "@src/js/components/common/FormFields/SelectField";
import TextareaField from "@src/js/components/common/FormFields/TextareaField";
import {
	Duration,
	ReservationFormData,
	courseTypes,
	dateCombinedOptions,
} from "@src/js/schema/reservationSchema";
import React from "react";
import { FieldErrors, UseFormRegister, UseFormWatch } from "react-hook-form";

type Props = {
	register: UseFormRegister<ReservationFormData>;
	errors: FieldErrors<ReservationFormData>;
	watch: UseFormWatch<ReservationFormData>;
	availableDurations: Duration[];
};

const StepReservationDetails: React.FC<Props> = ({
	register,
	errors,
	watch,
	availableDurations,
}) => {
	const courseDuration = watch("course-duration");
	const selectedCourseType = watch("course-type");
	const is3pOrSwap = [
		"3P 60分",
		"3P 90分",
		"3P 120分",
		"スワップ90分",
		"スワップ120分",
	].includes(courseDuration);
	const isLongCourse = [
		"ロング21:00~9:00",
		"ロング22:00~9:00",
		"ロング23:00~9:00",
		"ロング24:00~9:00",
	].includes(courseDuration);
	const isDateOnly = selectedCourseType === courseTypes.DATE_ONLY;
	const isSwap = ["スワップ90分", "スワップ120分"].includes(courseDuration);
	const is3p = ["3P 60分", "3P 90分", "3P 120分"].includes(courseDuration);
	const showDateCombined =
		selectedCourseType === courseTypes.PRIVATE_ROOM ||
		selectedCourseType === courseTypes.DELIVERY;

	return (
		<>
			<SelectField<ReservationFormData>
				label="ご希望のコース"
				name="course-type"
				register={register}
				errors={errors}
				options={Object.entries(courseTypes).map(([, value]) => ({
					value: value,
					label: value,
				}))}
				placeholder="コースを選択"
				required
			/>

			{selectedCourseType === courseTypes.OTHER && (
				<InputField<ReservationFormData>
					label="その他のコース"
					name="other-course"
					register={register}
					errors={errors}
					placeholder="ご希望のコース内容を入力してください"
					required
				/>
			)}

			{selectedCourseType && selectedCourseType !== courseTypes.OTHER && (
				<SelectField<ReservationFormData>
					label="コース時間"
					name="course-duration"
					register={register}
					errors={errors}
					options={availableDurations}
					placeholder="時間を選択"
					required
				/>
			)}

			{showDateCombined && (
				<SelectField<ReservationFormData>
					label="デート併用"
					name="date-combined"
					register={register}
					errors={errors}
					options={dateCombinedOptions}
					placeholder="なし"
				/>
			)}

			<DateTimePicker
				register={register}
				watch={watch}
				errors={errors}
				monthFieldName="reservation-month"
				dayFieldName="reservation-day"
				hourFieldName="reservation-hour"
				minuteFieldName="reservation-minute"
				label="予約日時"
				required
			/>

			<InputField<ReservationFormData>
				label="ご指名のボーイ"
				name="cast-name"
				register={register}
				errors={errors}
				placeholder="ボーイの名前を入力してください"
				required
			/>
			{!isDateOnly && (
				<SelectField<ReservationFormData>
					label="アナルプレイ"
					name="cast-anal-play"
					register={register}
					errors={errors}
					options={[
						{ value: "特になし", label: "特になし" },
						{
							value: "ボーイのバックウケ（お客様が挿入）",
							label: "ボーイのバックウケ（お客様が挿入）",
						},
						{
							value: "ボーイのバックタチ（お客様へ挿入）",
							label: "ボーイのバックタチ（お客様へ挿入）",
						},
						{ value: "両方", label: "両方" },
					]}
					placeholder="選択してください"
					required
				/>
			)}
			{(isLongCourse || isDateOnly) && (
				<RadioGroupField<ReservationFormData>
					label="コース中お食事の有無"
					name="has-meal-during-course"
					register={register}
					errors={errors}
					options={[
						{ value: "有り", label: "有り" },
						{ value: "無し", label: "無し" },
					]}
					required
					useButtonStyles
					selectedValue={watch("has-meal-during-course")}
				/>
			)}
			{is3pOrSwap && (
				<>
					<InputField<ReservationFormData>
						label="2人目のボーイ"
						name="cast2-name"
						register={register}
						errors={errors}
						placeholder="2人目のボーイの名前を入力してください"
						required
					/>
					{!isDateOnly && (
						<SelectField<ReservationFormData>
							label="2人目のボーイのアナルプレイ"
							name="cast2-anal-play"
							register={register}
							errors={errors}
							options={[
								{ value: "特になし", label: "特になし" },
								{
									value: "ボーイのバックウケ（お客様が挿入）",
									label: "ボーイのバックウケ（お客様が挿入）",
								},
								{
									value: "ボーイのバックタチ（お客様へ挿入）",
									label: "ボーイのバックタチ（お客様へ挿入）",
								},
								{ value: "両方", label: "両方" },
							]}
							placeholder="選択してください"
							required
						/>
					)}
				</>
			)}

			{selectedCourseType === courseTypes.DELIVERY && (
				<InputField<ReservationFormData>
					label="出張先（ホテル名・住所など）"
					name="delivery-location"
					register={register}
					errors={errors}
					placeholder="出張先の詳細を入力してください"
					required
				/>
			)}

			{is3p && (
				<RadioGroupField<ReservationFormData>
					label="ボーイ同士の絡み希望の有無（+4,000円）"
					name="boy-interaction"
					register={register}
					errors={errors}
					options={[
						{ value: "有り", label: "有り" },
						{ value: "無し", label: "無し" },
					]}
					required
					useButtonStyles
					selectedValue={watch("boy-interaction")}
				/>
			)}
			<RadioGroupField<ReservationFormData>
				label="割引チケットの有無"
				name="has-discount-ticket"
				register={register}
				errors={errors}
				options={[
					{ value: "有り", label: "有り" },
					{ value: "無し", label: "無し" },
				]}
				required
				useButtonStyles
				selectedValue={watch("has-discount-ticket")}
			/>

			<TextareaField<ReservationFormData>
				label="プレイ・コースでのご要望・お問い合わせ（任意）"
				name="play-requests"
				register={register}
				errors={errors}
				placeholder="ご希望のプレイ内容や特別なリクエストがございましたらご記入ください"
			/>
		</>
	);
};

export default StepReservationDetails;
