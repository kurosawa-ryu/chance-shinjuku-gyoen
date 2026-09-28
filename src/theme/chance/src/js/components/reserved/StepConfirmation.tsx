import {
	ReservationFormData,
	courseDurations,
	courseTypes,
} from "@src/js/schema/reservationSchema";
import React from "react";
import { Alert, Table } from "react-bootstrap";
import { UseFormWatch } from "react-hook-form";

type Props = {
	watch: UseFormWatch<ReservationFormData>;
};

const StepConfirmation: React.FC<Props> = ({ watch }) => {
	const formData = watch();
	const is3pOrSwap = [
		"3P 60分",
		"3P 90分",
		"3P 120分",
		"スワップ90分",
		"スワップ120分",
	].includes(formData["course-duration"]);
	const isLongCourse = [
		"ロング21:00~9:00",
		"ロング22:00~9:00",
		"ロング23:00~9:00",
		"ロング24:00~9:00",
	].includes(formData["course-duration"]);
	const isDateOnly = formData["course-type"] === courseTypes.DATE_ONLY;
	const isSwap = ["スワップ90分", "スワップ120分"].includes(
		formData["course-duration"],
	);
	const is3p = ["3P 60分", "3P 90分", "3P 120分"].includes(
		formData["course-duration"],
	);
	const hasDateCombined =
		formData["date-combined"] && formData["date-combined"] !== "なし";

	return (
		<>
			<div className="confirmation-section mb-4">
				<h5 className="mb-3">予約内容</h5>
				<Table borderless size="sm">
					<tbody>
						<tr>
							<th>コース</th>
							<td>{formData["course-type"]}</td>
						</tr>
						{formData["course-type"] !== courseTypes.OTHER && (
							<tr>
								<th>コース時間</th>
								<td>
									{Object.values(courseDurations)
										.flat()
										.find((d) => d.value === formData["course-duration"])
										?.label || formData["course-duration"]}
								</td>
							</tr>
						)}
						{hasDateCombined && (
							<tr>
								<th>デート併用</th>
								<td>{formData["date-combined"]}</td>
							</tr>
						)}
						{formData["course-type"] === courseTypes.OTHER && (
							<tr>
								<th>その他のコース</th>
								<td>{formData["other-course"]}</td>
							</tr>
						)}
						<tr>
							<th>予約日時</th>
							<td>
								{formData["reservation-month"]}月{formData["reservation-day"]}日{" "}
								{formData["reservation-hour"]}:{formData["reservation-minute"]}
							</td>
						</tr>
						<tr>
							<th>ご指名のボーイ</th>
							<td>{formData["cast-name"]}</td>
						</tr>
						{formData["course-type"] === courseTypes.DELIVERY && (
							<tr>
								<th>出張先</th>
								<td>{formData["delivery-location"]}</td>
							</tr>
						)}
						<tr>
							<th>アナルプレイ</th>
							<td>{formData["cast-anal-play"]}</td>
						</tr>
						{is3pOrSwap && (
							<tr>
								<th>2人目のボーイのアナルプレイ</th>
								<td>{formData["cast2-anal-play"]}</td>
							</tr>
						)}
						{is3p && (
							<tr>
								<th>ボーイ同士の絡み希望（+4,000円）</th>
								<td>{formData["boy-interaction"]}</td>
							</tr>
						)}
						<tr>
							<th>割引チケット</th>
							<td>{formData["has-discount-ticket"]}</td>
						</tr>
						{formData["play-requests"] && (
							<tr>
								<th>プレイ・コースでのご要望</th>
								<td>{formData["play-requests"]}</td>
							</tr>
						)}
						{(isLongCourse || isDateOnly) && (
							<tr>
								<th>コース中お食事の有無</th>
								<td>{formData["has-meal-during-course"]}</td>
							</tr>
						)}
					</tbody>
				</Table>
			</div>

			<div className="confirmation-section mb-4">
				<h5 className="mb-3">お客様情報</h5>
				<Table borderless size="sm">
					<tbody>
						<tr>
							<th>お名前</th>
							<td>{formData["your-name"]}</td>
						</tr>
						<tr>
							<th>メールアドレス</th>
							<td>{formData["your-email"]}</td>
						</tr>
						<tr>
							<th>電話番号</th>
							<td>{formData["your-tel"]}</td>
						</tr>
						<tr>
							<th>過去の{formData["cast-name"]}の指名有無</th>
							<td>{formData["has-previous-cast"]}</td>
						</tr>
						<tr>
							<th>当店の利用有無</th>
							<td>{formData["has-previous-visit"]}</td>
						</tr>
						{is3pOrSwap && (
							<tr>
								<th>過去の{formData["cast2-name"]}の指名有無</th>
								<td>{formData["has-previous-cast2"]}</td>
							</tr>
						)}
					</tbody>
				</Table>
			</div>

			<Alert variant="info" className="mb-4">
				<Alert.Heading>ご確認ください</Alert.Heading>
				<p className="mb-0">
					予約内容に問題がなければ「予約を確定する」ボタンを押してください。
					内容を修正する場合は「戻る」ボタンで前の画面に戻ることができます。
				</p>
			</Alert>
		</>
	);
};

export default StepConfirmation;
