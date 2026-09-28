import React from "react";
import { Alert, Button } from "react-bootstrap";

const ThanksPage: React.FC = () => {
	return (
		<div className="thanks-page text-center p-4">
			<h4 className="mb-4">ご応募ありがとうございます</h4>

			<Alert variant="info" className="mb-4">
				<Alert.Heading className="h5">
					ご応募の確認メールをお送りしました
				</Alert.Heading>
				<p className="mb-0">
					確認メールが届かない場合は、お手数ですが当店までご連絡ください。
					<br />
					後ほど採用担当よりご連絡させていただきます。今しばらくお待ちください。
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
