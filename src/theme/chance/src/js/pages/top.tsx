import React, { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import TopSlider, { type SliderItem } from "../components/top/TopSlider";

document.addEventListener("DOMContentLoaded", () => {
	const rootElem = document.getElementById("top_slider");

	if (rootElem) {
		const sliderData: SliderItem[] = JSON.parse(
			rootElem.dataset.slider || "[]",
		);

		const root = createRoot(rootElem);
		root.render(
			<StrictMode>
				<TopSlider sliderData={sliderData} />
			</StrictMode>,
		);
	}
});
