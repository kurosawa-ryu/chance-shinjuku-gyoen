import { RecruitFormData } from "@src/js/schema/recruitSchema";
import React from "react";
import { Alert, Table } from "react-bootstrap";
import { UseFormWatch } from "react-hook-form";

type Props = {
	watch: UseFormWatch<RecruitFormData>;
};

const StepRecruitConfirmation: React.FC<Props> = ({ watch }) => {
	const formData = watch();
	return (
		<>
			<div className="confirmation-section mb-4">
				<h5 className="mb-3">応募内容のご確認</h5>
				<Table borderless size="sm">
					<tbody>
						<tr>
							<th>氏名</th>
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
							<th>面接希望日時</th>
							<td>
								{formData["interview-month"]}月{formData["interview-day"]}日
								{formData["interview-hour"]}時{formData["interview-minute"]}分
							</td>
						</tr>
						<tr>
							<th>１週間の出勤希望日数</th>
							<td>
								{formData["warking-daies"]
									? `${formData["warking-daies"]}日`
									: ""}
							</td>
						</tr>
						<tr>
							<th>身長</th>
							<td>
								{formData["your-highe"] ? `${formData["your-highe"]}cm` : ""}
							</td>
						</tr>
						<tr>
							<th>体重</th>
							<td>
								{formData["your-waigh"] ? `${formData["your-waigh"]}kg` : ""}
							</td>
						</tr>
						<tr>
							<th>年齢</th>
							<td>{formData["your-age"] ? `${formData["your-age"]}歳` : ""}</td>
						</tr>
						<tr>
							<th>寮の希望有無</th>
							<td>{formData["your-dormitory"]}</td>
						</tr>
						<tr>
							<th>掲載画像のモザイク希望有無</th>
							<td>{formData["your-moza"]}</td>
						</tr>
						<tr>
							<th>他店での勤務経験</th>
							<td>{formData["your-experience"]}</td>
						</tr>
						{formData["your-message"] && (
							<tr>
								<th>その他希望、質問等</th>
								<td>{formData["your-message"]}</td>
							</tr>
						)}
					</tbody>
				</Table>
			</div>
			<Alert variant="info" className="mb-4">
				<Alert.Heading>ご確認ください</Alert.Heading>
				<p className="mb-0">
					応募内容に問題がなければ「送信する」ボタンを押してください。
					内容を修正する場合は「戻る」ボタンで前の画面に戻ることができます。
				</p>
			</Alert>
		</>
	);
};

export default StepRecruitConfirmation;
