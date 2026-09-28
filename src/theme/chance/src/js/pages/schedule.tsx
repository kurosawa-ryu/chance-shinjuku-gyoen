import React, { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import DaysSlider from "../components/schedule/DaysSlider";
import WeekSlider from "../components/schedule/WeekSlider";

document.addEventListener("DOMContentLoaded", () => {
	const rootElem = document.getElementById("schedule-day");
	const weekSliderElem = document.querySelector(".week_slider");

	if (rootElem) {
		const root = createRoot(rootElem);
		const activeDay = Number(rootElem.getAttribute("data-active-day"));
		const lang = rootElem.getAttribute("data-lang") || "ja";
		root.render(<DaysSlider activeDay={activeDay} lang={lang} />);
	}

	if (weekSliderElem) {
		const weekSliderContent = weekSliderElem.innerHTML;
		const root = createRoot(weekSliderElem);
		root.render(
			<StrictMode>
				<WeekSlider>
					{/* biome-ignore lint: reason */}
					<div dangerouslySetInnerHTML={{ __html: weekSliderContent }} />
				</WeekSlider>
			</StrictMode>,
		);
	}
});
