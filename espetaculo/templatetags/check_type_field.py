from django import template
register = template.Library()


def fieldtype(field):
    return field.field.widget.__class__.__name__


register.filter('fieldtype', fieldtype)
