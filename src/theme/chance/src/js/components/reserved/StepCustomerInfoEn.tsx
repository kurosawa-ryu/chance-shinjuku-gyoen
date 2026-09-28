import InputFieldEn from "@src/js/components/common/FormFields/InputFieldEn";
import RadioGroupFieldEn from "@src/js/components/common/FormFields/RadioGroupFieldEn";
import { ReservationFormData } from "@src/js/schema/reservationSchema";
import React from "react";
import { FieldErrors, UseFormRegister, UseFormWatch } from "react-hook-form";

type Props = {
	register: UseFormRegister<ReservationFormData>;
	errors: FieldErrors<ReservationFormData>;
	watch: UseFormWatch<ReservationFormData>;
};

const StepCustomerInfoEn: React.FC<Props> = ({ register, errors, watch }) => {
	const castName = watch("cast-name");
	const castName2 = watch("cast2-name");
	return (
		<>
			<InputFieldEn<ReservationFormData>
				label="Name"
				name="your-name"
				register={register}
				errors={errors}
				required
			/>

			<InputFieldEn<ReservationFormData>
				label="Email Address"
				name="your-email"
				register={register}
				errors={errors}
				type="email"
				placeholder="example@email.com"
				required
			/>

			<InputFieldEn<ReservationFormData>
				label="Email Address (Confirmation)"
				name="email-confirm"
				register={register}
				errors={errors}
				type="email"
				placeholder="example@email.com"
				required
			/>

			<InputFieldEn<ReservationFormData>
				label="Phone Number"
				name="your-tel"
				register={register}
				errors={errors}
				type="tel"
				placeholder="090-1234-5678"
			/>

			<RadioGroupFieldEn<ReservationFormData>
				label={`Previous appointment with ${castName || "this boy"}`}
				name="has-previous-cast"
				register={register}
				errors={errors}
				options={[
					{ value: "yes", label: "Yes" },
					{ value: "no", label: "No" },
				]}
				required
				useButtonStyles
				selectedValue={watch("has-previous-cast")}
			/>
			{castName2 && (
				<RadioGroupFieldEn<ReservationFormData>
					label={`Previous appointment with ${castName2}`}
					name="has-previous-cast2"
					register={register}
					errors={errors}
					options={[
						{ value: "有り", label: "Yes" },
						{ value: "無し", label: "No" },
					]}
					required
					useButtonStyles
					selectedValue={watch("has-previous-cast2")}
				/>
			)}

			<RadioGroupFieldEn<ReservationFormData>
				label="Previous visit to our store"
				name="has-previous-visit"
				register={register}
				errors={errors}
				options={[
					{ value: "有り", label: "Yes" },
					{ value: "無し", label: "No" },
				]}
				required
				useButtonStyles
				selectedValue={watch("has-previous-visit")}
			/>
		</>
	);
};

export default StepCustomerInfoEn;
