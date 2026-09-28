import { zodResolver } from "@hookform/resolvers/zod";
import React from "react";
import { Alert, Button, Form } from "react-bootstrap";
import { useForm } from "react-hook-form";
import { z } from "zod";

const reservationSchema = z.object({
	name: z.string().min(1, "名前を入力してください"),
	email: z.string().email("有効なメールアドレスを入力してください"),
	phone: z
		.string()
		.regex(/^[0-9-]+$/, "電話番号は数字とハイフンのみ使用可能です"),
	date: z.string().min(1, "日付を選択してください"),
	time: z.string().min(1, "時間を選択してください"),
	message: z.string().optional(),
});

type ReservationFormData = z.infer<typeof reservationSchema>;

const ReservationForm: React.FC = () => {
	const {
		register,
		handleSubmit,
		formState: { errors },
	} = useForm<ReservationFormData>({
		resolver: zodResolver(reservationSchema),
	});

	const onSubmit = async (data: ReservationFormData) => {
		try {
			// TODO: APIエンドポイントに予約データを送信
			console.log(data);
		} catch (error) {
			console.error("予約送信エラー:", error);
		}
	};

	return (
		<Form onSubmit={handleSubmit(onSubmit)} className="reservation-form p-4">
			<Form.Group className="mb-3">
				<Form.Label>お名前 *</Form.Label>
				<Form.Control
					type="text"
					{...register("name")}
					isInvalid={!!errors.name}
				/>
				{errors.name && (
					<Form.Control.Feedback type="invalid">
						{errors.name.message}
					</Form.Control.Feedback>
				)}
			</Form.Group>

			<Form.Group className="mb-3">
				<Form.Label>メールアドレス *</Form.Label>
				<Form.Control
					type="email"
					{...register("email")}
					isInvalid={!!errors.email}
				/>
				{errors.email && (
					<Form.Control.Feedback type="invalid">
						{errors.email.message}
					</Form.Control.Feedback>
				)}
			</Form.Group>

			<Form.Group className="mb-3">
				<Form.Label>電話番号 *</Form.Label>
				<Form.Control
					type="tel"
					{...register("phone")}
					isInvalid={!!errors.phone}
				/>
				{errors.phone && (
					<Form.Control.Feedback type="invalid">
						{errors.phone.message}
					</Form.Control.Feedback>
				)}
			</Form.Group>

			<Form.Group className="mb-3">
				<Form.Label>予約日 *</Form.Label>
				<Form.Control
					type="date"
					{...register("date")}
					isInvalid={!!errors.date}
				/>
				{errors.date && (
					<Form.Control.Feedback type="invalid">
						{errors.date.message}
					</Form.Control.Feedback>
				)}
			</Form.Group>

			<Form.Group className="mb-3">
				<Form.Label>予約時間 *</Form.Label>
				<Form.Control
					as="select"
					{...register("time")}
					isInvalid={!!errors.time}
				>
					<option value="">選択してください</option>
					<option value="10:00">10:00</option>
					<option value="11:00">11:00</option>
					<option value="12:00">12:00</option>
					{/* 他の時間枠も追加 */}
				</Form.Control>
				{errors.time && (
					<Form.Control.Feedback type="invalid">
						{errors.time.message}
					</Form.Control.Feedback>
				)}
			</Form.Group>

			<Form.Group className="mb-3">
				<Form.Label>メッセージ（任意）</Form.Label>
				<Form.Control as="textarea" rows={3} {...register("message")} />
			</Form.Group>

			<Button variant="primary" type="submit" className="w-100">
				予約を確定する
			</Button>
		</Form>
	);
};

export default ReservationForm;
