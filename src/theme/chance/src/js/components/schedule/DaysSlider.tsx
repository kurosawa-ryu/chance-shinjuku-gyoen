import React, { useCallback, useEffect, useState } from "react";

import { addDays, format } from "date-fns";
import { ja } from "date-fns/locale";
import useEmblaCarousel from "embla-carousel-react";

interface Props {
	activeDay: number;
	lang: string;
}

const DaysSlider = ({ activeDay, lang }: Props): JSX.Element => {
	const [isMobile, setIsMobile] = useState(false);

	useEffect(() => {
		const checkMobile = () => {
			setIsMobile(window.innerWidth < 768);
		};

		checkMobile();
		window.addEventListener("resize", checkMobile);
		return () => window.removeEventListener("resize", checkMobile);
	}, []);

	const [emblaRef, emblaApi] = useEmblaCarousel({
		align: "center",
		containScroll: "trimSnaps",
		dragFree: true,
		slidesToScroll: 1,
		loop: false,
		startIndex: activeDay,
	});

	useEffect(() => {
		if (emblaApi) {
			emblaApi.scrollTo(activeDay);
		}
	}, [emblaApi, activeDay]);

	const scrollPrev = useCallback(() => {
		if (emblaApi) emblaApi.scrollPrev();
	}, [emblaApi]);

	const scrollNext = useCallback(() => {
		if (emblaApi) emblaApi.scrollNext();
	}, [emblaApi]);

	const today = new Date();
	const dates = Array.from({ length: 14 }, (_, i) => addDays(today, i));

	return (
		<div className="days-slider position-relative">
			<button
				type="button"
				className="btn position-absolute start-0 top-50 translate-middle-y z-1"
				onClick={scrollPrev}
				style={{ transform: "translateY(-50%)" }}
			>
				<span className="bi bi-chevron-left" />
			</button>

			<div
				className="overflow-hidden border rounded shadow-sm bg-white mx-4"
				ref={emblaRef}
			>
				<div className="d-flex flex-nowrap">
					{dates.map((date, index) => (
						<div
							key={date.toISOString()}
							className="flex-shrink-0"
							style={{
								width: isMobile ? "4.5rem" : "5.5rem",
								padding: "0 0.25rem",
							}}
						>
							<a
								href={
									lang === "ja"
										? `/schedule/?day_num=${index}`
										: `/en/schedule/?day_num=${index}`
								}
								className={`date-item text-center p-2 rounded text-decoration-none d-block ${index === activeDay ? "active" : ""}`}
							>
								<div className="fw-bold small">
									{format(date, "MM/dd", { locale: ja })}
								</div>
								<div className="text-muted smaller">
									(
									{lang === "ja"
										? format(date, "E", { locale: ja })
										: format(date, "E")}
									)
								</div>
							</a>
						</div>
					))}
				</div>
			</div>

			<button
				type="button"
				className="btn position-absolute end-0 top-50 translate-middle-y z-1"
				onClick={scrollNext}
				style={{ transform: "translateY(-50%)" }}
			>
				<span className="bi bi-chevron-right" />
			</button>
		</div>
	);
};

export default DaysSlider;
