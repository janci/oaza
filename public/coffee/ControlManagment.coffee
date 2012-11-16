class ControlManagment
  constructor: (adapter, configuration={})->
    defaultCfg =
      'selector': '.widget.manage'

    cfg = defaultCfg

    adapter(cfg.selector).on(
      'mouseenter': ()->
        mnblock = adapter('<div class="manageblock"><div class="mantitle">Hello world</div><a href="#" class="mandelete"></a><a href="#" class="manedit"></a></div>')
        adapter(this).prepend(mnblock);
        adapter(mnblock).fadeIn();

      'mouseleave': ()->
        adapter('.manageblock', this).fadeOut( ()->
          adapter(this).remove();
        )

    )
    #cfg.selector
    adapter('body').on('click','.manageblock .mandelete', ()->
      if(confirm('Opravdu chcete vymazať komponentu?'))
        adapter(this).parents(cfg.selector).remove();

      false;
    );

loadOaza = ()->
  cm = new ControlManagment(window.jQueryAdapter);

window.ControlManagment = ControlManagment
window.onload = loadOaza