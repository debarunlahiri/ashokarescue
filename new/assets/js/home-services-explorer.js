(() => {
  const explorer = document.querySelector("[data-service-explorer]");
  if (!explorer) return;
  const tabs = [...explorer.querySelectorAll("[data-service-tab]")];
  const panels = [...explorer.querySelectorAll("[data-service-panel]")];
  if (!tabs.length || tabs.length !== panels.length) return;
  const tablist = explorer.querySelector(".hx-tabs");
  tablist.setAttribute("role", "tablist");
  tablist.setAttribute("aria-orientation", "vertical");
  function select(index, focus = false) {
    tabs.forEach((tab, i) => {
      tab.setAttribute("aria-selected", String(i === index));
      tab.tabIndex = i === index ? 0 : -1;
      panels[i].hidden = i !== index;
    });
    if (focus) tabs[index].focus();
  }
  tabs.forEach((tab, index) => {
    tab.setAttribute("role", "tab");
    tab.setAttribute("aria-controls", panels[index].id);
    panels[index].setAttribute("role", "tabpanel");
    panels[index].setAttribute("aria-labelledby", tab.id);
    panels[index].tabIndex = 0;
    tab.addEventListener("click", (event) => {
      event.preventDefault();
      select(index);
    });
    tab.addEventListener("keydown", (event) => {
      let next;
      if (event.key === "ArrowDown") next = (index + 1) % tabs.length;
      if (event.key === "ArrowUp")
        next = (index + tabs.length - 1) % tabs.length;
      if (event.key === "Home") next = 0;
      if (event.key === "End") next = tabs.length - 1;
      if (event.key === " ") next = index;
      if (next !== undefined) {
        event.preventDefault();
        select(next, true);
      }
    });
  });
  select(0);
})();
