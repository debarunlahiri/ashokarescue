import { readFile, writeFile } from "node:fs/promises";
import { feature } from "topojson-client";
import { geoNaturalEarth1, geoMercator, geoPath, geoGraticule10 } from "d3-geo";

// Build-time geographic data only; the browser receives local SVG assets.
const world = JSON.parse(
    await readFile(
        new URL(
            "../node_modules/world-atlas/countries-110m.json",
            import.meta.url,
        ),
        "utf8",
    ),
);
const countries = feature(world, world.objects.countries).features.filter(
    (country) => country.id !== "010",
);
const india = countries.find((country) => country.id === "356");
const places = {
    Delhi: [77.209, 28.614],
    Mumbai: [72.878, 19.076],
    Chennai: [80.27, 13.083],
    Kolkata: [88.364, 22.573],
    Toronto: [-79.383, 43.653],
    Paris: [2.352, 48.857],
    Bangkok: [100.502, 13.756],
};
const escape = (value) =>
    value.replaceAll("&", "&amp;").replaceAll("<", "&lt;");

function buildMap(domestic) {
    const projection = domestic
        ? geoMercator().fitExtent(
              [
                  [145, 35],
                  [650, 405],
              ],
              india,
          )
        : geoNaturalEarth1().fitExtent(
              [
                  [24, 30],
                  [776, 405],
              ],
              { type: "FeatureCollection", features: countries },
          );
    projection.clipExtent([
        [10, 10],
        [790, 430],
    ]);
    const path = geoPath(projection).digits(1);
    const destinations = domestic
        ? ["Mumbai", "Chennai", "Kolkata"]
        : ["Toronto", "Paris", "Bangkok"];
    const title = domestic
        ? "Map of India with illustrative connections from Delhi to Mumbai, Chennai and Kolkata"
        : "World map with illustrative connections from Delhi to Toronto, Paris and Bangkok";
    const shapes = countries
        .map((country) => {
            const outline = path(country);
            return outline
                ? `<path d="${outline}" fill="${country.id === "356" ? "#287083" : "#1c3b50"}"/>`
                : "";
        })
        .join("\n");
    const routes = destinations
        .map(
            (name) =>
                `<path d="${path({ type: "LineString", coordinates: [places.Delhi, places[name]] })}"/>`,
        )
        .join("\n");
    const markers = ["Delhi", ...destinations]
        .map((name) => {
            const [x, y] = projection(places[name]);
            const hub = name === "Delhi";
            const label = !domestic && hub ? "INDIA · Delhi" : name;
            const above = name === "Paris" || name === "Kolkata" || hub;
            const labelX = x + (name === "Mumbai" ? -10 : 10);
            const anchor = name === "Mumbai" ? "end" : "start";
            return `<g><circle cx="${x.toFixed(1)}" cy="${y.toFixed(1)}" r="${hub ? 10 : 6}" fill="#8de5ee" opacity=".12"/><circle cx="${x.toFixed(1)}" cy="${y.toFixed(1)}" r="${hub ? 4 : 3}" fill="#a3edf4"/><text x="${labelX.toFixed(1)}" y="${(y + (above ? -13 : 19)).toFixed(1)}" text-anchor="${anchor}">${escape(label)}</text></g>`;
        })
        .join("\n");
    return `<svg xmlns="http://www.w3.org/2000/svg" width="800" height="440" viewBox="0 0 800 440" role="img" aria-labelledby="title desc">
<title id="title">${title}</title>
<desc id="desc">Natural Earth geographic country boundaries. Routes are illustrations, not live flights or confirmed availability.</desc>
<defs><radialGradient id="ocean"><stop stop-color="#15394c"/><stop offset="1" stop-color="#0b2135"/></radialGradient><clipPath id="bounds"><rect x="10" y="10" width="780" height="420" rx="10"/></clipPath></defs>
<rect width="800" height="440" fill="url(#ocean)"/>
<g clip-path="url(#bounds)">
<path d="${path(geoGraticule10())}" fill="none" stroke="#54788c" stroke-width=".5" opacity=".2"/>
<g stroke="#55798a" stroke-width="${domestic ? ".75" : ".5"}" stroke-linejoin="round">${shapes}</g>
<g fill="none" stroke="#86dfeb" stroke-width="1.6" stroke-dasharray="4 5" stroke-linecap="round">${routes}</g>
<g font-family="Arial,sans-serif" font-size="${domestic ? 13 : 11}" fill="#e0f6fa" stroke="#0b2135" stroke-width="3" paint-order="stroke" stroke-linejoin="round">${markers}</g>
</g></svg>`;
}
for (const domestic of [true, false]) {
    const filename = `coverage-${domestic ? "india" : "world"}.svg`;
    const content = buildMap(domestic);
    await writeFile(
        new URL(`../assets/images/${filename}`, import.meta.url),
        content,
    );
    console.log(
        `${filename}: ${countries.length} geographic country outlines, ${content.length} bytes`,
    );
}
