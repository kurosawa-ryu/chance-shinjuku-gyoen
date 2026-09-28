/**
 * URLクエリパラメータから指定されたパラメータの値を取得する
 * @param paramName 取得したいパラメータ名
 * @returns パラメータの値。存在しない場合はnull
 */
export const getQueryParam = (paramName: string): string | null => {
	if (typeof window === "undefined") {
		return null;
	}

	const params = new URLSearchParams(window.location.search);
	return params.get(paramName);
};
