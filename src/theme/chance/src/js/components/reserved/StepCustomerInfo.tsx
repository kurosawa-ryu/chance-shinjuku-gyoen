import InputField from "@src/js/components/common/FormFields/InputField";
import RadioGroupField from "@src/js/components/common/FormFields/RadioGroupField";
import { ReservationFormData } from "@src/js/schema/reservationSchema";
import React from "react";
import { FieldErrors, UseFormRegister, UseFormWatch } from "react-hook-form";

type Props = {
	register: UseFormRegister<ReservationFormData>;
	errors: FieldErrors<ReservationFormData>;
	watch: UseFormWatch<ReservationFormData>;
};

const StepCustomerInfo: React.FC<Props> = ({ register, errors, watch }) => {
	const castName = watch("cast-name");
	const castName2 = watch("cast2-name");
	return (
		<>
			<InputField<ReservationFormData>
				label="お名前"
				name="your-name"
				register={register}
				errors={errors}
				required
			/>

			<InputField<ReservationFormData>
				label="メールアドレス"
				name="your-email"
				register={register}
				errors={errors}
				type="email"
				placeholder="example@email.com"
				required
			/>

			<InputField<ReservationFormData>
				label="メールアドレス（確認用）"
				name="email-confirm"
				register={register}
				errors={errors}
				type="email"
				placeholder="example@email.com"
				required
			/>

			<InputField<ReservationFormData>
				label="電話番号"
				name="your-tel"
				register={register}
				errors={errors}
				type="tel"
				placeholder="090-1234-5678"
			/>

			<RadioGroupField<ReservationFormData>
				label={`過去に${castName || "今回のボーイ"}の指名有無`}
				name="has-previous-cast"
				register={register}
				errors={errors}
				options={[
					{ value: "有り", label: "有り" },
					{ value: "無し", label: "無し" },
				]}
				required
				useButtonStyles
				selectedValue={watch("has-previous-cast")}
			/>
			{castName2 && (
				<RadioGroupField<ReservationFormData>
					label={`過去に${castName2}の指名有無`}
					name="has-previous-cast2"
					register={register}
					errors={errors}
					options={[
						{ value: "有り", label: "有り" },
						{ value: "無し", label: "無し" },
					]}
					required
					useButtonStyles
					selectedValue={watch("has-previous-cast2")}
				/>
			)}

			<RadioGroupField<ReservationFormData>
				label="当店の利用有無"
				name="has-previous-visit"
				register={register}
				errors={errors}
				options={[
					{ value: "有り", label: "有り" },
					{ value: "無し", label: "無し" },
				]}
				required
				useButtonStyles
				selectedValue={watch("has-previous-visit")}
			/>
		</>
	);
};

export default StepCustomerInfo;
