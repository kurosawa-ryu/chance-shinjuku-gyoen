import { z } from "zod";

export const courseTypes = {
	PRIVATE_ROOM: "個室",
	DELIVERY: "出張",
	DATE_ONLY: "デートのみ",
	OTHER: "その他",
} as const;

export type Duration = {
	value: string;
	label: string;
};

// デート併用のオプション
export const dateCombinedOptions = [
	{ value: "60分", label: "60分" },
	{ value: "120分", label: "120分" },
];

export const courseDurations = {
	PRIVATE_ROOM: [
		{ value: "30分（オナニー鑑賞）", label: "30分（オナニー鑑賞）" },
		{ value: "60分", label: "60分" },
		{ value: "90分", label: "90分" },
		{ value: "120分", label: "120分" },
		{ value: "180分", label: "180分" },
		{ value: "ロング21:00~9:00", label: "ロング21:00~9:00" },
		{ value: "ロング22:00~9:00", label: "ロング22:00~9:00" },
		{ value: "ロング23:00~9:00", label: "ロング23:00~9:00" },
		{ value: "ロング24:00~9:00", label: "ロング24:00~9:00" },
		{ value: "3P 60分", label: "3P 60分" },
		{ value: "3P 90分", label: "3P 90分" },
		{ value: "3P 120分", label: "3P 120分" },
		{ value: "スワップ90分", label: "スワップ90分" },
		{ value: "スワップ120分", label: "スワップ120分" },
	],
	DELIVERY: [
		{ value: "60分", label: "60分" },
		{ value: "90分", label: "90分" },
		{ value: "120分", label: "120分" },
		{ value: "180分", label: "180分" },
		{ value: "ロング21:00~9:00", label: "ロング21:00~9:00" },
		{ value: "ロング22:00~9:00", label: "ロング22:00~9:00" },
		{ value: "ロング23:00~9:00", label: "ロング23:00~9:00" },
		{ value: "ロング24:00~9:00", label: "ロング24:00~9:00" },
		{ value: "3P 60分", label: "3P 60分" },
		{ value: "3P 90分", label: "3P 90分" },
		{ value: "3P 120分", label: "3P 120分" },
		{ value: "スワップ90分", label: "スワップ90分" },
		{ value: "スワップ120分", label: "スワップ120分" },
	],
	DATE_ONLY: [
		{ value: "60分", label: "60分" },
		{ value: "120分", label: "120分" },
	],
} as const;

export const reservationSchema = z
	.object({
		"course-type": z.string().min(1, "コースを選択してください"),
		"course-duration": z.string().min(1, "時間を選択してください"),
		"other-course": z.string().optional(),
		"date-combined": z.string().optional(),
		"reservation-month": z.string().min(1, "月を選択してください"),
		"reservation-day": z.string().min(1, "日を選択してください"),
		"reservation-hour": z.string().min(1, "時を選択してください"),
		"reservation-minute": z.string().min(1, "分を選択してください"),
		"cast-name": z.string().min(1, "ご指名のボーイを入力してください"),
		"cast2-name": z.string().optional(),
		"delivery-location": z.string().optional(),
		"cast-anal-play": z.string().optional(),
		"cast2-anal-play": z.string().optional(),
		"has-discount-ticket": z
			.string()
			.min(1, "割引チケットの有無を選択してください"),
		"play-requests": z.string().optional(),
		"your-name": z.string().min(1, "名前を入力してください"),
		"your-email": z
			.string()
			.email("有効なメールアドレスを入力してください")
			.min(1, "メールアドレスを入力してください"),
		"email-confirm": z
			.string()
			.email("有効なメールアドレスを入力してください")
			.or(z.literal(""))
			.optional(),
		"your-tel": z
			.string()
			.regex(/^[0-9-]+$/, "電話番号は数字とハイフンのみ使用可能です")
			.or(z.literal(""))
			.optional(),
		"has-previous-cast": z
			.string()
			.min(1, "過去のボーイ指名有無を選択してください"),
		"has-previous-cast2": z.string().optional(),
		"has-previous-visit": z.string().min(1, "当店の利用有無を選択してください"),
		"has-meal-during-course": z.string().optional(),
		"boy-interaction": z.string().optional(),
	})
	.refine(
		(data) => {
			if (data["course-type"] === courseTypes.DELIVERY) {
				if (!data["delivery-location"]) {
					return false;
				}
			}
			return true;
		},
		{
			message: "出張先を入力してください",
			path: ["deliveryLocation"],
		},
	)
	.refine(
		(data) => {
			if (data["your-email"] && data["your-email"] !== data["email-confirm"]) {
				return false;
			}
			return true;
		},
		{
			message: "メールアドレスが一致しません",
			path: ["email-confirm"],
		},
	)
	.refine(
		(data) => {
			const is3pOrSwap = [
				"3P 60分",
				"3P 90分",
				"3P 120分",
				"スワップ90分",
				"スワップ120分",
			].includes(data["course-duration"]);
			const isDateOnly = data["course-type"] === courseTypes.DATE_ONLY;
			if (is3pOrSwap && !isDateOnly) {
				return !!data["cast2-name"] && data["cast2-name"].trim().length > 0;
			}
			return true;
		},
		{
			message: "2人目のボーイ名を入力してください",
			path: ["cast2-name"],
		},
	)
	.refine(
		(data) => {
			const is3pOrSwap = [
				"3P 60分",
				"3P 90分",
				"3P 120分",
				"スワップ90分",
				"スワップ120分",
			].includes(data["course-duration"]);
			const isDateOnly = data["course-type"] === courseTypes.DATE_ONLY;
			if (is3pOrSwap && !isDateOnly) {
				return (
					!!data["cast2-anal-play"] && data["cast2-anal-play"].trim().length > 0
				);
			}
			return true;
		},
		{
			message: "2人目のボーイのアナルプレイを選択してください",
			path: ["cast2-anal-play"],
		},
	)
	.refine(
		(data) => {
			const isLongCourse = [
				"ロング21:00~9:00",
				"ロング22:00~9:00",
				"ロング23:00~9:00",
				"ロング24:00~9:00",
			].includes(data["course-duration"]);
			const isDateOnly = data["course-type"] === courseTypes.DATE_ONLY;
			if (isLongCourse || isDateOnly) {
				return (
					!!data["has-meal-during-course"] &&
					data["has-meal-during-course"].trim().length > 0
				);
			}
			return true;
		},
		{
			message: "コース中お食事の有無を選択してください",
			path: ["has-meal-during-course"],
		},
	)
	.refine(
		(data) => {
			const is3pOrSwap = [
				"3P 60分",
				"3P 90分",
				"3P 120分",
				"スワップ90分",
				"スワップ120分",
			].includes(data["course-duration"]);
			const isDateOnly = data["course-type"] === courseTypes.DATE_ONLY;
			if (is3pOrSwap && !isDateOnly) {
				return (
					!!data["has-previous-cast2"] &&
					data["has-previous-cast2"].trim().length > 0
				);
			}
			return true;
		},
		{
			message: "2人目のボーイ指名有無を選択してください",
			path: ["has-previous-cast2"],
		},
	)
	.refine(
		(data) => {
			const is3p = ["3P 60分", "3P 90分", "3P 120分"].includes(
				data["course-duration"],
			);
			if (is3p) {
				return (
					!!data["boy-interaction"] && data["boy-interaction"].trim().length > 0
				);
			}
			return true;
		},
		{
			message: "ボーイ同士の絡み希望の有無を選択してください",
			path: ["boy-interaction"],
		},
	);

export type ReservationFormData = z.infer<typeof reservationSchema>;
