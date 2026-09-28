import React from "react";
import { createRoot } from "react-dom/client";
import RecruitForm from "../components/recruit/RecruitForm";
// BootstrapのCSSは共通で読み込まれている想定であれば不要
// import "bootstrap/dist/css/bootstrap.min.css";

document.addEventListener("DOMContentLoaded", () => {
	const rootElem = document.getElementById("recruit-form");

	if (rootElem) {
		const root = createRoot(rootElem);
		root.render(
			<React.StrictMode>
				{/* 必要に応じてコンテナ要素やタイトルを追加 */}
				{/* <div className="container py-4"> */}
				{/* <h2 className="mb-4">求人応募フォーム</h2> */}
				<RecruitForm />
				{/* </div> */}
			</React.StrictMode>,
		);
	}
});
