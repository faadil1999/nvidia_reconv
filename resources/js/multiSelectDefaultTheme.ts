const multiselectStyle = {
    container:
        'relative p-1 w-full flex cursor-pointer rounded-lg bg-white focus-within:ring-1 focus-within:ring-theme-500 focus-within:border-theme-500',
    containerDisabled: 'cursor-default bg-zinc-100',
    containerOpen: 'rounded-b-none',
    containerOpenTop: 'rounded-t-none',
    containerActive: 'ring-1 ring-theme-500 border-theme-500',
    wrapper: 'w-full flex items-center justify-end',
    singleLabel:
        'flex items-center h-full max-w-full absolute left-0 top-0 pointer-events-none bg-transparent leading-5 pl-3.5 pr-16 box-border rtl:left-auto rtl:right-0 rtl:pl-0 rtl:pr-3.5',
    singleLabelText:
        'overflow-ellipsis overflow-hidden block whitespace-nowrap max-w-full',
    multipleLabel:
        'flex items-center h-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3.5 rtl:left-auto rtl:right-0 rtl:pl-0 rtl:pr-3.5',
    search: 'w-full  outline-none focus:ring-0 appearance-none box-border border-0 text-sm font-medium leading-5 bg-white rounded-lg pl-2.5 rtl:pl-0 rtl:pr-3.5',
    tags: 'flex-grow flex-shrink flex flex-wrap items-center mt-1 pl-2 rtl:pl-0 rtl:pr-2',
    tag: 'bg-red-600 text-white text-sm font-semibold py-0.5 pl-2 rounded mr-1 mb-1 flex items-center rtl:pl-0 rtl:pr-2 rtl:mr-0 rtl:ml-1',
    tagDisabled: 'pr-2 opacity-50 rtl:pl-2',
    tagRemove:
        'flex items-center justify-center p-1 mx-0.5 rounded-sm hover:bg-black hover:bg-opacity-10 group',
    tagRemoveIcon:
        'bg-multiselect-remove bg-center bg-no-repeat opacity-30 inline-block w-3 h-3 group-hover:opacity-60',
    tagsSearchWrapper:
        'inline-block relative mx-1 mb-1 flex-grow flex-shrink h-full',
    tagsSearch:
        'absolute inset-0 border-0 outline-none focus:ring-0 appearance-none p-0 text-base font-sans box-border w-full',
    tagsSearchCopy: 'invisible whitespace-pre-wrap inline-block h-px',
    placeholder:
        'flex items-center h-full absolute left-0 top-0 pointer-events-none bg-transparent text-sm font-medium leading-5 pl-3.5 text-zinc-500 rtl:left-auto rtl:right-0 rtl:pl-0 rtl:pr-3.5',
    caret: 'bg-multiselect-caret bg-center bg-no-repeat w-2.5 h-4 py-px box-content mr-3.5 relative z-10 opacity-40 flex-shrink-0 flex-grow-0 transition-transform transform pointer-events-none rtl:mr-0 rtl:ml-3.5',
    caretOpen: 'rotate-180 pointer-events-auto',
    clear: 'pr-3.5 relative z-10 opacity-40 transition duration-300 flex-shrink-0 flex-grow-0 flex hover:opacity-80 rtl:pr-0 rtl:pl-3.5',
    clearIcon:
        'bg-multiselect-remove bg-center bg-no-repeat w-2.5 h-4 py-px box-content inline-block',
    spinner:
        'bg-multiselect-spinner bg-center bg-no-repeat w-4 h-4 z-10 mr-3.5 animate-spin flex-shrink-0 flex-grow-0 rtl:mr-0 rtl:ml-3.5',
    inifite: 'flex items-center justify-center w-full',
    inifiteSpinner:
        'bg-multiselect-spinner bg-center bg-no-repeat w-4 h-4 z-10 animate-spin flex-shrink-0 flex-grow-0 m-3.5',
    dropdown:
        'max-h-60 absolute -left-px -right-px transform  border border-zinc-300 -mt-px overflow-y-scroll z-50 bg-white flex flex-col rounded-b',
    dropdownTop:
        '-translate-y-full top-px bottom-auto rounded-b-none rounded-t',
    dropdownHidden: 'hidden',
    options: 'flex flex-col p-0 m-0 list-none',
    optionsTop: '',
    group: 'p-0 m-0',
    groupLabel:
        'flex text-sm box-border items-center justify-start text-left py-1 px-3 font-semibold bg-zinc-200 cursor-default leading-normal',
    groupLabelPointable: 'cursor-pointer',
    groupLabelPointed: 'bg-zinc-300 text-zinc-700',
    groupLabelSelected: 'bg-theme-600 text-white',
    groupLabelDisabled: 'bg-zinc-100 text-zinc-300 cursor-not-allowed',
    groupLabelSelectedPointed: 'bg-theme-600 text-white opacity-90',
    groupLabelSelectedDisabled:
        'text-theme-500/10 bg-theme-600 bg-opacity-50 cursor-not-allowed',
    groupOptions: 'p-0 m-0',
    option: 'flex items-center justify-start box-border text-left cursor-pointer text-base leading-snug py-2 px-3',
    optionPointed: 'text-theme-600 bg-theme-500/20 ',
    optionSelected: 'text-white bg-red-600 font-semibold',
    optionDisabled: 'text-zinc-300 cursor-not-allowed',
    optionSelectedPointed: 'text-white bg-red-600 font-semibold',
    optionSelectedDisabled:
        'text-red-500/10 bg-theme-500 bg-opacity-50 cursor-not-allowed',
    noOptions: 'py-2 px-3 text-zinc-600 bg-white text-left',
    noResults: 'py-2 px-3 text-zinc-600 bg-white text-left',
    fakeInput:
        'bg-transparent absolute left-0 right-0 -bottom-px w-full h-px border-0 p-0 appearance-none outline-none text-transparent',
    spacer: 'h-9 py-px',
    assist: 'hidden',
};

export default multiselectStyle;
