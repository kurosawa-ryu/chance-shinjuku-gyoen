import React from "react";
import { Alert, Button } from "react-bootstrap";

const ThanksPage: React.FC = () => {
	return (
		<div className="thanks-page text-center p-4">
			<h4 className="mb-4">ご予約ありがとうございます</h4>

			<Alert variant="info" className="mb-4">
				<Alert.Heading className="h5">
					ご予約の確認メールをお送りしました
				</Alert.Heading>
				<p className="mb-0">
					ご登録いただいたメールアドレス宛に、予約内容の確認メールをお送りしました。
					<br />
					メールが届かない場合は、お手数ですが当店までご連絡ください。
				</p>
			</Alert>

			<div className="d-grid gap-2">
				<Button variant="primary" href="/">
					トップページへ
				</Button>
				<Button variant="outline-primary" href="/cast">
					在籍ボーイ一覧へ
				</Button>
			</div>
		</div>
	);
};

export default ThanksPage;
