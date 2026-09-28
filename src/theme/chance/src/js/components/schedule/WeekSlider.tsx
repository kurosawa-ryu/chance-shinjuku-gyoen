import useEmblaCarousel from "embla-carousel-react";
import React, { useCallback } from "react";

type Props = {
	children: React.ReactNode;
};

const WeekSlider: React.FC<Props> = ({ children }) => {
	const [emblaRef, emblaApi] = useEmblaCarousel({
		align: "start",
		containScroll: "trimSnaps",
		dragFree: true,
		slidesToScroll: 1,
	});

	const scrollPrev = useCallback(() => {
		if (emblaApi) emblaApi.scrollPrev();
	}, [emblaApi]);

	const scrollNext = useCallback(() => {
		if (emblaApi) emblaApi.scrollNext();
	}, [emblaApi]);

	return (
		<div className="schedule-slider">
			<div className="schedule-slider__viewport" ref={emblaRef}>
				<div className="schedule-slider__container">{children}</div>
			</div>
			<button
				type="button"
				className="schedule-slider__button schedule-slider__button--prev"
				onClick={scrollPrev}
			>
				<span className="bi bi-chevron-left" />
			</button>
			<button
				type="button"
				className="schedule-slider__button schedule-slider__button--next"
				onClick={scrollNext}
			>
				<span className="bi bi-chevron-right" />
			</button>
		</div>
	);
};

export default WeekSlider;
