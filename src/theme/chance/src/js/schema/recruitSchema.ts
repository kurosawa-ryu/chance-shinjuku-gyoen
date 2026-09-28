import { z } from "zod";

export const recruitSchema = z
	.object({
		"your-name": z.string().min(1, "氏名を入力してください"),
		"your-email": z.string().email("有効なメールアドレスを入力してください"),
		"email-confirm": z.string().email("有効なメールアドレスを入力してください"),
		"your-tel": z
			.string()
			.min(1, "電話番号を入力してください")
			.regex(/^[0-9-]+$/, "電話番号は数字とハイフンのみ使用可能です"),
		"interview-month": z.string().min(1, "面接希望月を選択してください"),
		"interview-day": z.string().min(1, "面接希望日を選択してください"),
		"interview-hour": z.string().min(1, "面接希望時間を選択してください"),
		"interview-minute": z.string().min(1, "面接希望分を選択してください"),
		"warking-daies": z
			.string()
			.min(1, "１週間の出勤希望日数を選択してください"),
		"your-highe": z
			.string()
			.min(1, "身長を入力してください")
			.regex(/^[0-9]*$/, "身長は数字で入力してください"),
		"your-waigh": z
			.string()
			.min(1, "体重を入力してください")
			.regex(/^[0-9]*$/, "体重は数字で入力してください"),
		"your-age": z
			.string()
			.min(1, "年齢を入力してください")
			.regex(/^[0-9]*$/, "年齢は数字で入力してください"),
		"your-dormitory": z.string().min(1, "寮の希望有無を選択してください"),
		"your-moza": z
			.string()
			.min(1, "掲載画像のモザイク希望有無を選択してください"),
		"your-experience": z.string().min(1, "他店での勤務経験を選択してください"),
		"your-message": z.string().optional(),
	})
	.refine((data) => data["your-email"] === data["email-confirm"], {
		message: "メールアドレスが一致しません",
		path: ["email-confirm"],
	});

export type RecruitFormData = z.infer<typeof recruitSchema>;
