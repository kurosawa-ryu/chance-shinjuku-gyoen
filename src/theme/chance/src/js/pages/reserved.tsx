import React from "react";
import { createRoot } from "react-dom/client";
import ReservationForm from "../components/reserved/ReservationForm";
import ReservationFormEn from "../components/reserved/ReservationFormEn";
import "bootstrap/dist/css/bootstrap.min.css";

document.addEventListener("DOMContentLoaded", () => {
	const rootElem = document.getElementById("reserved-form");

	if (rootElem) {
		const root = createRoot(rootElem);
		const lang = rootElem.getAttribute("data-lang") || "ja";
		root.render(
			<div className="container py-4">
				{lang === "ja" ? <ReservationForm /> : <ReservationFormEn />}
			</div>,
		);
	}
});
