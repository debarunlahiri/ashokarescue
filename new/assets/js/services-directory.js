(() => {
  const search = document.getElementById("sr-search");
  const cards = Array.from(document.querySelectorAll("[data-service-card]"));
  const tools = document.querySelector("[data-service-tools]");
  const count = document.getElementById("sr-result-count");
  const empty = document.getElementById("sr-no-results");
  const clear = document.getElementById("sr-clear-search");

  if (!search || !tools || !count || !empty || !clear || !cards.length) return;

  const entries = cards.map((card) => ({
    card,
    text: card.textContent.toLocaleLowerCase(),
  }));

  function filterServices() {
    const terms = search.value
      .trim()
      .toLocaleLowerCase()
      .split(/\s+/)
      .filter(Boolean);
    let visible = 0;
    entries.forEach(({ card, text }) => {
      const matches = terms.every((term) => text.includes(term));
      card.hidden = !matches;
      if (matches) visible += 1;
    });
    count.textContent = `${visible} of ${cards.length} services`;
    empty.hidden = visible !== 0;
  }

  tools.hidden = false;
  search.addEventListener("input", filterServices);
  clear.addEventListener("click", () => {
    search.value = "";
    filterServices();
    search.focus();
  });
  filterServices();
})();
