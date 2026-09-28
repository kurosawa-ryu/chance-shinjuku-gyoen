import React, { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import ImageSliderPortal from "../components/cast/ImageSliderPortal";
import SchedulePortal from "../components/cast/SchedulePortal";
import { CastProvider } from "../context/CastContext";

document.addEventListener("DOMContentLoaded", () => {
	const rootElem = document.getElementById("cast_root");

	if (rootElem) {
		const root = createRoot(rootElem);

		root.render(
			<StrictMode>
				<CastProvider>
					<ImageSliderPortal />
					<SchedulePortal />
				</CastProvider>
			</StrictMode>,
		);
	}
});
