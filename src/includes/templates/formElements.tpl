{foreach from = $elements item = "element"}
	{if is_array($element)}
		{include file = "formElements.tpl" elements=$element}
	{else}
		{if $element->getType() eq 'ElementHidden'}
			<input type = "hidden" name = "{$element->getName()}" value = "{$element->getValue()}" />
		{elseif $element->getType() eq 'ElementHtml'}
			{$element->getValue()}
		{elseif $element->getType() eq 'ElementButton'}
			<button value = "{$form->getName()}" name = "{$element->getName()}" type = "submit">{$element->getCaption()}</button>
		{else}
			<label class = "{($element->isRequired()) ? 'required' : 'optional'}" for = "{$element->getName()}">{$element->getCaption()}</label>

			<div>
			{$element->render()}
			</div>

			<p class = "description">
			{if $element->description ne ''}
				{$element->description}
			{/if}
			<p>

			<div class = "suggested">
			{if !empty($suggestedValues)}
				{foreach from = $suggestedValues key = sv item = caption}
					<span class = "dummyLink" onclick = "document.getElementById('{$element->getName()}').value = '{$sv} '">{$caption}</span>';
				{/foreach}
			{/if}
			</div>

			<p class = "formValidationError">
			{if $element->getValidationError() ne ''}
				{$element->getValidationError()}
			{/if}
			</p>
		{/if}
	{/if}
{/foreach}


