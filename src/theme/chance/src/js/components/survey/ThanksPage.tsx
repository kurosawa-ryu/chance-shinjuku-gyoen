import React from "react";
import { Alert, Button } from "react-bootstrap";

const ThanksPage: React.FC = () => {
	return (
		<div className="thanks-page text-center p-4">
			<h4 className="mb-4">アンケートのご回答ありがとうございます</h4>

			<Alert variant="info" className="mb-4">
				<Alert.Heading className="h5">アンケートが送信されました</Alert.Heading>
				<p className="mb-0">
					お客様からいただいたご意見は、サービス向上のために活用させていただきます。
					<br />
					またのご利用を心よりお待ちしております。
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
