import react from "@vitejs/plugin-react";
import { defineConfig } from "vite";

export default defineConfig({
	plugins: [react()],
	root: "src/theme/chance",
	base: "./",
	resolve: {
		alias: {
			"@src/": "/src/",
		},
	},
	build: {
		outDir: "./",
		target: "es2015",
		sourcemap: true,
		rollupOptions: {
			input: {
				style: "/src/sass/style.scss",
				admin: "/src/sass/admin.scss",
				// create: "/src/sass/create.scss", // 不要になったため削除
				cushion: "/src/sass/cushion.scss",
				app: "/entries/js/app.ts",
				top: "/entries/js/top.ts",
				cast: "/entries/js/cast.ts",
				schedule: "/entries/js/schedule.ts",
				reserved: "/entries/js/reserved.ts",
				survey: "/entries/js/survey.ts",
				recruit: "/entries/js/recruit.ts",
			},
			output: {
				format: "es", // 追加
				entryFileNames: "assets/[name].js",
				chunkFileNames: "assets/[name].js",
				assetFileNames: "assets/[name].[ext]",
			},
		},
		commonjsOptions: {
			transformMixedEsModules: true,
		},
		define: {
			"window.jQuery": "jQuery",
			"window.$": "jQuery",
		},
	},
});
