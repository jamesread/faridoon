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
			<label id = "lbl-{$element->getName()}" class = "{($element->isRequired()) ? 'required' : 'optional'}" for = "{$element->getName()}">{$element->getCaption()}</label>

			<div>
			{$element->render()}
			</div>

			<div class = "description {if $element->description eq ''}empty{else}notempty{/if}">
				<p>{$element->description}</p>
			</div>

			<div class = "suggested {if empty($suggestedValues)}empty{else}notempty{/if}">
				{if !empty($suggestedValues)}
					{foreach from = $suggestedValues key = sv item = caption}
						<span class = "dummyLink" onclick = "document.getElementById('{$element->getName()}').value = '{$sv} '">{$caption}</span>';
					{/foreach}
				{/if}
			</div>

			<div class = "{if $element->getValidationError() eq ''}empty{else}notempty{/if}">
				<p class = "formValidationError">{$element->getValidationError()}</p>
			</div>
		{/if}
	{/if}
{/foreach}


