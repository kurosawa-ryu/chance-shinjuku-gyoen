import React from "react";
import { createRoot } from "react-dom/client";
import SurveyForm from "../components/survey/SurveyForm";
import SurveyFormEn from "../components/survey/SurveyFormEn";
import "bootstrap/dist/css/bootstrap.min.css";

document.addEventListener("DOMContentLoaded", () => {
	const rootElem = document.getElementById("survey-form");

	if (rootElem) {
		const root = createRoot(rootElem);
		const lang = rootElem.getAttribute("data-lang") || "ja";

		root.render(
			<div className="container py-4">
				{lang === "ja" ? <SurveyForm /> : <SurveyFormEn />}
			</div>,
		);
	}
});
