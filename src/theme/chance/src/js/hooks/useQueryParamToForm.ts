import { getQueryParam } from "@src/js/utils/queryParams";
import { useEffect } from "react";
import {
	type FieldValues,
	type Path,
	type UseFormSetValue,
} from "react-hook-form";

/**
 * URLクエリパラメータの値をフォームフィールドに自動設定するカスタムフック
 *
 * @param paramName - 取得するクエリパラメータ名
 * @param fieldName - 設定先のフォームフィールド名
 * @param setValue - React Hook FormのsetValue関数
 *
 * @example
 * ```tsx
 * const { setValue } = useForm<MyFormData>();
 * useQueryParamToForm("boy", "cast-name", setValue);
 * ```
 */
export const useQueryParamToForm = <TFieldValues extends FieldValues>(
	paramName: string,
	fieldName: Path<TFieldValues>,
	setValue: UseFormSetValue<TFieldValues>,
) => {
	useEffect(() => {
		const paramValue = getQueryParam(paramName);
		if (paramValue) {
			setValue(fieldName, paramValue as never, {
				shouldValidate: true,
				shouldDirty: true,
			});
		}
	}, [paramName, fieldName, setValue]);
};
