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

export const courseDurations = {
	PRIVATE_ROOM: [
		{ value: "30分（オナニー鑑賞）", label: "30分（オナニー鑑賞）" },
		{ value: "40分", label: "40分" },
		{ value: "60分", label: "60分" },
		{ value: "90分", label: "90分" },
		{ value: "120分", label: "120分" },
		{ value: "180分", label: "180分" },
		{ value: "ロング", label: "ロング" },
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
		{ value: "ロング", label: "ロング" },
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

export const surveySchema = z
	.object({
		"course-type": z.string().min(1, "コースを選択してください"),
		"course-duration": z.string().min(1, "時間を選択してください"),
		"other-course": z.string().optional(),
		"reservation-month": z.string().min(1, "月を選択してください"),
		"reservation-day": z.string().min(1, "日を選択してください"),
		"reservation-hour": z.string().min(1, "時を選択してください"),
		"reservation-minute": z.string().min(1, "分を選択してください"),
		"cast-name": z.string().min(1, "ご指名のボーイを入力してください"),
		"your-name": z.string().min(1, "名前を入力してください"),
		"your-email": z
			.string()
			.email("有効なメールアドレスを入力してください")
			.min(1, "メールアドレスを入力してください"),
		"email-confirm": z
			.string()
			.email("有効なメールアドレスを入力してください")
			.min(1, "メールアドレス（確認）を入力してください"),
		// 当店の利用回数
		"visit-count": z.string().min(1, "当店の利用回数を選択してください"),
		// キャストのレビュー
		"cast-review": z.string().optional(),
		// レビューの公開
		"publisibal-cast-review": z.string().optional(),
		// 第一印象
		"cast-impression": z.string().min(1, "第一印象を選択してください"),
		// キャストの写真とのギャップ
		"cast-photo-gap": z.string().min(1, "写真とのギャップを選択してください"),
		// キャストの言葉遣い
		"cast-language": z.string().min(1, "言葉遣いを選択してください"),
		// キャストのサービス
		"cast-service": z.union([z.string(), z.array(z.string())]).optional(),
		// キャストをまた指名しますか？
		"cast-again": z.string().min(1, "また指名しますか？を選択してください"),
		// 受付の対応
		"reception-response": z.string().optional(),
		// 電話の受付対応で気になったこと
		"reception-response-concern": z
			.union([z.string(), z.array(z.string())])
			.optional(),
		// Webサイトについて
		"website-concern": z.string().optional(),
		// 当店のシステムについて
		"system-concern": z.string().optional(),
		// 価格設定について
		"price-concern": z.string().optional(),
		// その他ご意見ご要望
		"other-concern": z.string().optional(),
	})
	.refine(
		(data) => {
			return data["your-email"] === data["email-confirm"];
		},
		{
			message: "メールアドレスが一致しません",
			path: ["email-confirm"],
		},
	);

export type SurveyFormData = z.infer<typeof surveySchema>;
